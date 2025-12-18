<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display the landing page (home).
     */
    public function index()
    {
        $produks = Produk::with('kategori')->latest()->take(8)->get();
        $kategoris = Kategori::addSelect(['gambar_terbaru' => Produk::select('gambar')
            ->whereColumn('kategori_id', 'kategoris.id')
            ->latest()
            ->limit(1),
        ])->get();

        return view('landing.home', compact('produks', 'kategoris'));
    }

    /**
     * Display the product catalog page (katalog).
     */
    public function produk(Request $request)
    {
        $produks = Produk::with('kategori');

        if ($request->kategori) {
            $produks->where('kategori_id', $request->kategori);
        }

        if ($request->sort === 'price_low') {
            $produks->orderBy('harga', 'asc');
        } elseif ($request->sort === 'price_high') {
            $produks->orderBy('harga', 'desc');
        } else {
            $produks->latest();
        }

        $produks = $produks->paginate(12)->withQueryString();
        $kategoris = Kategori::all();

        return view('landing.produk', compact('produks', 'kategoris'));
    }

    /**
     * Display the specified product detail.
     */
    public function show(Produk $produk)
    {
        $produk->load('kategori');

        $relatedProducts = Produk::where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->take(4)
            ->get();

        return view('landing.detail-produk', compact('produk', 'relatedProducts'));
    }

    public function profil()
    {
        return view('landing.profil');
    }

    public function keranjang()
    {
        $cart = session()->get('cart', []);

        // Transform session cart data into a collection of objects for the view
        $cartItems = collect($cart)->map(function ($details, $id) {
            $product = Produk::find($id);
            if ($product) {
                // Determine quantity locally to avoid saving it to the database model accidentally
                $product->quantity = $details['quantity'];
                $product->selected_size = $details['size'] ?? 'M';
                $product->selected_color = $details['color'] ?? 'Standard';

                return $product;
            }

            return null;
        })->filter(); // Remove nulls if product deleted from DB

        return view('landing.keranjang', compact('cartItems'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Produk::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'quantity' => 1,
                'size' => $request->size ?? 'M',
                'color' => $request->color ?? 'Standard',
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Barang anda sudah di masukkan ke keranjang, silahkan checkout');
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $quantity = $request->input('quantity');

            // Ensure quantity is valid
            if ($quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Keranjang berhasil diperbarui!');
            } else {
                // Remove item if quantity is 0 or less
                unset($cart[$id]);
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
            }
        }

        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed successfully!');
    }
}
