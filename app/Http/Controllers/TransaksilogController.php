<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksilogController extends Controller
{
    /**
     * Display a listing of all transactions for admin.
     * Acceptance Criteria: Admin dapat melihat seluruh transaksi pelanggan.
     */
    public function index(Request $request)
    {
        $query = Transaksi::with(['user', 'details']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Search by kode_transaksi, nama_penerima, or user name/email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_transaksi', 'like', "%{$search}%")
                    ->orWhere('nama_penerima', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $transaksis = $query->latest()->paginate(10)->withQueryString();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * Display the specified transaction detail.
     * Acceptance Criteria: Admin dapat melihat detail masing-masing transaksi.
     */
    public function show(Transaksi $transaksi_log)
    {
        $transaksi_log->load(['user', 'details.produk', 'logs.admin']);

        return view('admin.transaksi.show', ['transaksi' => $transaksi_log]);
    }

    public function update(Request $request, Transaksi $transaksi_log)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,processing,shipped,completed,cancelled',
            'no_resi' => 'nullable|string|max:100',
            'kurir' => 'nullable|string|max:50',
            'catatan' => 'nullable|string|max:500',
        ]);

        $oldStatus = $transaksi_log->status;
        $newStatus = $request->status;

        // Validasi: Jika status = shipped, wajib ada no_resi
        if ($newStatus === 'shipped' && empty($request->no_resi)) {
            return back()->with('error', 'Nomor resi wajib diisi saat status diubah ke Dikirim.');
        }

        DB::beginTransaction();
        try {
            // Update transaksi
            $transaksi_log->status = $newStatus;

            // Update no_resi dan kurir jika ada
            if ($request->filled('no_resi')) {
                $transaksi_log->no_resi = $request->no_resi;
            }
            if ($request->filled('kurir')) {
                $transaksi_log->kurir = $request->kurir;
            }

            // Update timestamp berdasarkan status
            if ($newStatus === 'shipped' && $oldStatus !== 'shipped') {
                $transaksi_log->shipped_at = now();
            }
            if ($newStatus === 'completed' && $oldStatus !== 'completed') {
                $transaksi_log->completed_at = now();
            }

            // Jika dibatalkan, kembalikan saldo user
            if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
                $user = $transaksi_log->user;
                $user->balance += $transaksi_log->total_harga;
                $user->save();

                Log::info('Refund processed', [
                    'transaksi_id' => $transaksi_log->id,
                    'user_id' => $user->id,
                    'amount' => $transaksi_log->total_harga,
                ]);
            }

            $transaksi_log->save();

            // Catat perubahan di transaksi_logs
            // Acceptance Criteria: Semua perubahan status wajib dicatat di database
            TransaksiLog::create([
                'transaksi_id' => $transaksi_log->id,
                'admin_id' => Auth::id(),
                'status_lama' => $oldStatus,
                'status_baru' => $newStatus,
                'catatan' => $request->catatan,
            ]);

            DB::commit();

            Log::info('Transaction status updated', [
                'transaksi_id' => $transaksi_log->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'admin_id' => Auth::id(),
            ]);

            return redirect()->route('transaksi_log.show', $transaksi_log->id)
                ->with('success', "Status berhasil diubah dari '{$oldStatus}' ke '{$newStatus}'.");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update transaction status', ['error' => $e->getMessage()]);

            return back()->with('error', 'Gagal mengubah status transaksi.');
        }
    }

    /**
     * Not used - transactions are created by customers, not admin.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Not used - transactions are created by customers, not admin.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Show edit form - redirect to show page with edit modal.
     */
    public function edit(Transaksi $transaksi_log)
    {
        return redirect()->route('transaksi_log.show', $transaksi_log->id);
    }

    /**
     * Not used - transactions should not be deleted, only cancelled.
     */
    public function destroy(Transaksi $transaksi_log)
    {
        abort(404);
    }
}
