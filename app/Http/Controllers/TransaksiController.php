<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    /**
     * Display a listing of user's transactions.
     */
    public function index()
    {
        $transaksis = Transaksi::with('details.produk')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('landing.transaksi.index', compact('transaksis'));
    }

    /**
     * Show checkout page with cart items.
     */
    public function create()
    {
        $cart = session()->get('cart', []);

        // If cart is empty, redirect back
        if (empty($cart)) {
            return redirect()->route('landing.keranjang')
                ->with('error', 'Keranjang Anda kosong. Silakan tambahkan produk terlebih dahulu.');
        }

        // Transform cart to cartItems collection (same logic as LandingController)
        $cartItems = collect($cart)->map(function ($details, $id) {
            $product = Produk::find($id);
            if ($product) {
                $product->quantity = $details['quantity'];
                $product->selected_size = $details['size'] ?? 'M';
                $product->selected_color = $details['color'] ?? 'Standard';

                return $product;
            }

            return null;
        })->filter();

        // Calculate totals
        $subtotal = $cartItems->sum(fn ($item) => $item->harga * $item->quantity);

        return view('landing.transaksi.create', compact('cartItems', 'subtotal'));
    }

    /**
     * Store a newly created transaction (Checkout Process).
     */
    public function store(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required|string',
            'nama_penerima' => 'required|string|max:255',
            'no_telp_penerima' => 'required|string|max:20',
            'catatan' => 'nullable|string',
        ]);

        $user = Auth::user();
        $cart = session()->get('cart', []);

        // Check if cart is empty
        if (empty($cart)) {
            return back()->with('error', 'Keranjang Anda kosong!');
        }

        DB::beginTransaction();
        try {
            // 1. Get cart items and calculate subtotal
            $subtotal = 0;
            $itemsData = [];

            foreach ($cart as $produkId => $details) {
                $produk = Produk::lockForUpdate()->findOrFail($produkId);
                $quantity = $details['quantity'];

                // Check stock availability
                if ($produk->stok < $quantity) {
                    throw new \Exception("Stok produk {$produk->nama} tidak mencukupi (Tersedia: {$produk->stok}).");
                }

                $hargaSatuan = $produk->harga;
                $itemSubtotal = $hargaSatuan * $quantity;

                $subtotal += $itemSubtotal;

                $itemsData[] = [
                    'produk_id' => $produk->id,
                    'nama_produk' => $produk->nama,
                    'harga_satuan' => $hargaSatuan,
                    'quantity' => $quantity,
                    'subtotal' => $itemSubtotal,
                ];
            }

            // 2. Calculate ongkir (for now 0, can be changed later)
            $ongkir = 0;
            $totalHarga = $subtotal + $ongkir;

            // 3. Check if user balance is sufficient
            if ($user->balance < $totalHarga) {
                return back()->with('error', 'Saldo tidak mencukupi! Silakan top up terlebih dahulu.');
            }

            // 4. Create new transaction
            $transaksi = Transaksi::create([
                'user_id' => $user->id,
                'subtotal' => $subtotal,
                'ongkir' => $ongkir,
                'total_harga' => $totalHarga,
                'alamat_pengiriman' => $request->alamat_pengiriman,
                'nama_penerima' => $request->nama_penerima,
                'no_telp_penerima' => $request->no_telp_penerima,
                'catatan' => $request->catatan,
                'status' => 'pending',
            ]);

            // 5. Save item details and update stock
            foreach ($itemsData as $itemData) {
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $itemData['produk_id'],
                    'nama_produk' => $itemData['nama_produk'],
                    'harga_satuan' => $itemData['harga_satuan'],
                    'quantity' => $itemData['quantity'],
                    'subtotal' => $itemData['subtotal'],
                ]);

                // Decrement stock
                $produk = Produk::find($itemData['produk_id']);
                $produk->decrement('stok', $itemData['quantity']);
            }

            // 6. Deduct user balance
            $user->balance -= $totalHarga;
            $user->save();

            // 7. Update transaction status to 'paid'
            $transaksi->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            // 8. Clear cart from session
            session()->forget('cart');

            DB::commit();

            Log::info('Transaction created', [
                'transaksi_id' => $transaksi->id,
                'kode_transaksi' => $transaksi->kode_transaksi,
                'total' => $totalHarga,
            ]);

            return redirect()->route('transaksi.show', $transaksi->id)
                ->with('success', 'Pesanan berhasil dibuat! Silakan tunggu konfirmasi dari admin.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction failed', ['error' => $e->getMessage()]);

            return back()->with('error', 'Terjadi kesalahan saat membuat pesanan. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified transaction (Invoice/Detail).
     */
    public function show(Transaksi $transaksi)
    {
        // Pastikan user hanya bisa lihat transaksi sendiri
        if ($transaksi->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $transaksi->load('details.produk');

        return view('landing.transaksi.show', compact('transaksi'));
    }

    /**
     * Cancel transaction (only if not paid yet).
     */
    public function cancel(Transaksi $transaksi)
    {
        // Pastikan user hanya bisa cancel transaksi sendiri
        if ($transaksi->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Hanya bisa cancel jika masih pending atau paid (belum diproses)
        if (! in_array($transaksi->status, ['pending', 'paid'])) {
            return back()->with('error', 'Transaksi tidak dapat dibatalkan.');
        }

        DB::beginTransaction();
        try {
            // Kembalikan saldo user jika sudah dibayar
            if ($transaksi->status === 'paid') {
                $user = $transaksi->user;
                $user->balance += $transaksi->total_harga;
                $user->save();
            }

            // Kembalikan stok produk
            foreach ($transaksi->details as $detail) {
                $produk = Produk::find($detail->produk_id);
                if ($produk) {
                    $produk->increment('stok', $detail->quantity);
                }
            }

            // Update status jadi cancelled
            $transaksi->update(['status' => 'cancelled']);

            DB::commit();

            return back()->with('success', 'Pesanan berhasil dibatalkan. Saldo telah dikembalikan.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Cancel transaction failed', ['error' => $e->getMessage()]);

            return back()->with('error', 'Gagal membatalkan pesanan.');
        }
    }
}
