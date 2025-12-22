<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Topup;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Pendapatan (dari transaksi completed)
        $totalRevenue = Transaksi::where('status', 'completed')
            ->sum('total_harga');

        // Pendapatan bulan ini
        $revenueThisMonth = Transaksi::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_harga');

        // Pendapatan bulan lalu (untuk perbandingan)
        $revenueLastMonth = Transaksi::where('status', 'completed')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('total_harga');

        // Persentase growth revenue
        $revenueGrowth = $revenueLastMonth > 0
            ? round((($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100, 1)
            : 0;

        // Total Users
        $totalUsers = User::where('role', 'user')->count();

        // User baru bulan ini
        $newUsersThisMonth = User::where('role', 'user')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Total Orders (semua transaksi)
        $totalOrders = Transaksi::count();

        // Orders bulan ini
        $ordersThisMonth = Transaksi::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Orders bulan lalu
        $ordersLastMonth = Transaksi::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        // Orders growth
        $ordersGrowth = $ordersLastMonth > 0
            ? round((($ordersThisMonth - $ordersLastMonth) / $ordersLastMonth) * 100, 1)
            : 0;

        // Total Produk
        $totalProducts = Produk::count();

        // Transaksi pending (perlu diproses)
        $pendingOrders = Transaksi::whereIn('status', ['paid', 'processing'])->count();

        // Topup pending
        $pendingTopups = Topup::where('status', 'pending')->count();

        // Recent Transactions (5 terbaru)
        $recentTransactions = Transaksi::with('user')
            ->latest()
            ->limit(5)
            ->get();

        // Produk terlaris (top 5)
        $topProducts = DB::table('transaksi_details')
            ->join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->join('produks', 'transaksi_details.produk_id', '=', 'produks.id')
            ->where('transaksis.status', 'completed')
            ->select(
                'produks.id',
                'produks.nama',
                'produks.gambar',
                DB::raw('SUM(transaksi_details.quantity) as total_sold')
            )
            ->groupBy('produks.id', 'produks.nama', 'produks.gambar')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        // Prepare chart data: Monthly Revenue for the last 12 months
        $monthlyRevenueData = Transaksi::where('status', 'completed')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_harga) as total')
            )
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $revenueLabels = [];
        $revenueData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $revenueLabels[] = $date->format('M Y');

            $found = $monthlyRevenueData->first(function ($item) use ($date) {
                return $item->year == $date->year && $item->month == $date->month;
            });

            $revenueData[] = $found ? $found->total : 0;
        }

        // Prepare chart data: Order Status Distribution
        $orderStatusData = Transaksi::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $chartStatuses = ['pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled'];
        $statusCounts = [];
        foreach ($chartStatuses as $status) {
            $statusCounts[] = $orderStatusData[$status] ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalRevenue',
            'revenueThisMonth',
            'revenueGrowth',
            'totalUsers',
            'newUsersThisMonth',
            'totalOrders',
            'ordersThisMonth',
            'ordersGrowth',
            'totalProducts',
            'pendingOrders',
            'pendingTopups',
            'recentTransactions',
            'topProducts',
            'revenueLabels',
            'revenueData',
            'chartStatuses',
            'statusCounts'
        ));
    }
}
