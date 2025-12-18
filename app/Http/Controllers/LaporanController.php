<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Default: 30 hari terakhir
        $filter = $request->get('filter', '30_days');

        // Tentukan range tanggal berdasarkan filter
        switch ($filter) {
            case 'today':
                $startDate = now()->startOfDay();
                $endDate = now()->endOfDay();
                $filterLabel = 'Hari Ini';
                break;
            case '7_days':
                $startDate = now()->subDays(6)->startOfDay();
                $endDate = now()->endOfDay();
                $filterLabel = '7 Hari Terakhir';
                break;
            case '30_days':
                $startDate = now()->subDays(29)->startOfDay();
                $endDate = now()->endOfDay();
                $filterLabel = '30 Hari Terakhir';
                break;
            case 'this_month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                $filterLabel = 'Bulan Ini';
                break;
            case 'custom':
                $startDate = $request->filled('start_date')
                    ? \Carbon\Carbon::parse($request->start_date)->startOfDay()
                    : now()->subDays(29)->startOfDay();
                $endDate = $request->filled('end_date')
                    ? \Carbon\Carbon::parse($request->end_date)->endOfDay()
                    : now()->endOfDay();
                $filterLabel = 'Custom Range';
                break;
            default:
                $startDate = now()->subDays(29)->startOfDay();
                $endDate = now()->endOfDay();
                $filterLabel = '30 Hari Terakhir';
        }

        // Query Summary dengan aggregation (efficient JOIN + SUM)
        $summary = Transaksi::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('
                COUNT(*) as total_transaksi,
                COALESCE(SUM(subtotal), 0) as total_penjualan,
                COALESCE(SUM(total_harga), 0) as total_pendapatan
            ')
            ->first();

        // Query Transaksi dalam range (untuk tabel detail)
        $transaksis = Transaksi::with(['user', 'details'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Query Produk Terlaris (efficient JOIN + SUM)
        $topProducts = TransaksiDetail::join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->join('produks', 'transaksi_details.produk_id', '=', 'produks.id')
            ->where('transaksis.status', 'completed')
            ->whereBetween('transaksis.created_at', [$startDate, $endDate])
            ->select(
                'produks.id',
                'produks.nama',
                'produks.gambar',
                DB::raw('SUM(transaksi_details.quantity) as total_qty'),
                DB::raw('SUM(transaksi_details.subtotal) as total_revenue')
            )
            ->groupBy('produks.id', 'produks.nama', 'produks.gambar')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        // Data untuk chart (penjualan per hari)
        $dailySales = Transaksi::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(total_harga) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.laporan.index', compact(
            'summary',
            'transaksis',
            'topProducts',
            'dailySales',
            'filter',
            'filterLabel',
            'startDate',
            'endDate'
        ));
    }
}
