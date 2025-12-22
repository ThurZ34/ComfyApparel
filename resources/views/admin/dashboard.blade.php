@extends('layouts.app')

@section('header')
    Dashboard Overview
@endsection

@section('content')
    <div class="space-y-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Total Revenue -->
            <div
                class="relative overflow-hidden bg-comfy-800 text-white p-6 rounded-2xl shadow-xl transform transition duration-300 hover:-translate-y-1 hover:shadow-2xl group">
                <div
                    class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 bg-white/10 rounded-full opacity-20 group-hover:scale-150 transition-transform duration-500">
                </div>

                <div class="flex items-center justify-between mb-4 relative z-10">
                    <h3 class="text-comfy-200 text-xs font-semibold uppercase tracking-wider">Total Pendapatan</h3>
                    <span class="p-2 bg-white/10 border border-white/10 rounded-lg text-comfy-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <p class="text-3xl font-bold tracking-tight mb-1 relative z-10">Rp
                    {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                <div class="mt-4 flex items-center text-sm relative z-10">
                    <span class="text-comfy-200 bg-white/10 px-2 py-0.5 rounded flex items-center gap-1 font-medium">
                        @if ($revenueGrowth >= 0)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 4.5l15 15m0 0V8.25m0 11.25H8.25" />
                            </svg>
                        @endif
                        {{ $revenueGrowth }}%
                    </span>
                    <span class="text-comfy-200/70 ml-2">dari bulan lalu</span>
                </div>
            </div>

            <!-- Card 2: Active Users -->
            <div
                class="bg-white border border-zinc-100 p-6 rounded-2xl shadow-sm hover:border-comfy-500/30 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-zinc-500 text-xs font-semibold uppercase tracking-wider">Total Pengguna</h3>
                    <span class="p-2 bg-comfy-50 rounded-lg text-comfy-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </span>
                </div>
                <p class="text-3xl font-bold text-zinc-900 tracking-tight">{{ number_format($totalUsers) }}</p>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-comfy-800 bg-comfy-50 px-2 py-0.5 rounded flex items-center gap-1 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                        +{{ $newUsersThisMonth }}
                    </span>
                    <span class="text-zinc-400 ml-2">bulan ini</span>
                </div>
            </div>

            <!-- Card 3: Total Orders -->
            <div
                class="bg-white border border-zinc-100 p-6 rounded-2xl shadow-sm hover:border-comfy-500/30 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-zinc-500 text-xs font-semibold uppercase tracking-wider">Total Pesanan</h3>
                    <span class="p-2 bg-comfy-50 rounded-lg text-comfy-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </span>
                </div>
                <p class="text-3xl font-bold text-zinc-900 tracking-tight">{{ number_format($totalOrders) }}</p>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-comfy-800 bg-comfy-50 px-2 py-0.5 rounded flex items-center gap-1 font-medium">
                        @if ($ordersGrowth >= 0)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 4.5l15 15m0 0V8.25m0 11.25H8.25" />
                            </svg>
                        @endif
                        {{ $ordersGrowth }}%
                    </span>
                    <span class="text-zinc-400 ml-2">dari bulan lalu</span>
                </div>
            </div>

            <!-- Card 4: Pending Items -->
            <div
                class="bg-white border border-zinc-100 p-6 rounded-2xl shadow-sm hover:border-comfy-500/30 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-zinc-500 text-xs font-semibold uppercase tracking-wider">Perlu Diproses</h3>
                    <span class="p-2 bg-orange-50 rounded-lg text-orange-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <p class="text-3xl font-bold text-zinc-900 tracking-tight">{{ $pendingOrders + $pendingTopups }}</p>
                <div class="mt-4 flex items-center gap-3 text-sm">
                    <span class="text-orange-600 bg-orange-50 px-2 py-0.5 rounded font-medium">{{ $pendingOrders }}
                        Order</span>
                    <span class="text-blue-600 bg-blue-50 px-2 py-0.5 rounded font-medium">{{ $pendingTopups }}
                        Topup</span>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Revenue Chart -->
            <div class="lg:col-span-2 bg-white border border-zinc-100 p-6 rounded-2xl shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-zinc-900">Pendapatan Bulanan</h3>
                        <p class="text-sm text-zinc-500">Overview pendapatan 12 bulan terakhir</p>
                    </div>
                    <div class="flex gap-2">
                        <span
                            class="flex items-center gap-1 text-xs font-medium text-comfy-600 bg-comfy-50 px-2 py-1 rounded-full">
                            <span class="w-2 h-2 rounded-full bg-comfy-600"></span>
                            Pendapatan
                        </span>
                    </div>
                </div>
                <div class="relative h-72 w-full">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Order Status Chart -->
            <div class="bg-white border border-zinc-100 p-6 rounded-2xl shadow-sm">
                <h3 class="text-lg font-bold text-zinc-900 mb-2">Status Pesanan</h3>
                <p class="text-sm text-zinc-500 mb-6">Distribusi status semua pesanan</p>
                <div class="relative h-64 w-full flex items-center justify-center">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Transactions -->
            <div class="lg:col-span-2 bg-white border border-zinc-200 rounded-2xl shadow-sm">
                <div class="p-6 border-b border-zinc-100 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-zinc-900">Transaksi Terbaru</h2>
                    <a href="{{ route('transaksi_log.index') }}"
                        class="text-sm font-medium text-comfy-800 hover:text-comfy-900">Lihat Semua</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-comfy-50/50 text-zinc-500 text-xs uppercase tracking-wider">
                                <th class="px-6 py-3 font-semibold">Kode</th>
                                <th class="px-6 py-3 font-semibold">Pelanggan</th>
                                <th class="px-6 py-3 font-semibold">Tanggal</th>
                                <th class="px-6 py-3 font-semibold">Total</th>
                                <th class="px-6 py-3 font-semibold text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100">
                            @forelse($recentTransactions as $trx)
                                <tr class="group hover:bg-zinc-50 transition-colors">
                                    <td class="px-6 py-4 text-zinc-900 font-medium whitespace-nowrap">
                                        {{ $trx->kode_transaksi }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-linear-to-br from-comfy-50 to-comfy-200 border border-comfy-200 flex items-center justify-center text-xs font-bold text-comfy-800">
                                                {{ substr($trx->user->name ?? 'U', 0, 1) }}
                                            </div>
                                            <div class="text-sm font-medium text-zinc-700">{{ $trx->user->name ?? '-' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-zinc-500 text-sm whitespace-nowrap">
                                        {{ $trx->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-zinc-900 font-semibold whitespace-nowrap">
                                        Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        @php
                                            $statusClass = match ($trx->status) {
                                                'completed' => 'bg-green-100 text-green-800',
                                                'shipped' => 'bg-indigo-100 text-indigo-800',
                                                'processing' => 'bg-purple-100 text-purple-800',
                                                'paid' => 'bg-blue-100 text-blue-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                                default => 'bg-yellow-100 text-yellow-800',
                                            };
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                                            {{ ucfirst($trx->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-zinc-500">Belum ada transaksi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Products -->
            <div class="bg-white border border-zinc-200 rounded-2xl shadow-sm">
                <div class="p-6 border-b border-zinc-100 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-zinc-900">Produk Terlaris</h2>
                    <a href="{{ route('laporan.index') }}"
                        class="text-sm font-medium text-comfy-800 hover:text-comfy-900">Lihat Laporan</a>
                </div>

                <div class="p-4">
                    @forelse($topProducts as $index => $product)
                        <div class="flex items-center gap-3 py-3 {{ !$loop->last ? 'border-b border-zinc-100' : '' }}">
                            <span
                                class="shrink-0 w-6 h-6 flex items-center justify-center text-xs font-bold rounded-full {{ $index < 3 ? 'bg-comfy-800 text-white' : 'bg-zinc-200 text-zinc-600' }}">
                                {{ $index + 1 }}
                            </span>
                            <div class="shrink-0 w-10 h-10 bg-zinc-100 rounded-lg overflow-hidden">
                                @if ($product->gambar)
                                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}"
                                        class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-zinc-900 truncate">{{ $product->nama }}</p>
                                <p class="text-xs text-zinc-500">{{ $product->total_sold }} terjual</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-zinc-500 py-8">Belum ada data</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white border border-zinc-200 rounded-2xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-zinc-900 mb-4">Statistik Ringkas</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-zinc-50 rounded-xl p-4 text-center hover:bg-zinc-100 transition-colors">
                    <p class="text-2xl font-bold text-zinc-900">{{ $totalProducts }}</p>
                    <p class="text-sm text-zinc-500">Total Produk</p>
                </div>
                <div class="bg-zinc-50 rounded-xl p-4 text-center hover:bg-zinc-100 transition-colors">
                    <p class="text-2xl font-bold text-zinc-900">{{ $ordersThisMonth }}</p>
                    <p class="text-sm text-zinc-500">Order Bulan Ini</p>
                </div>
                <div class="bg-zinc-50 rounded-xl p-4 text-center hover:bg-zinc-100 transition-colors">
                    <p class="text-2xl font-bold text-zinc-900">Rp
                        {{ number_format($revenueThisMonth, 0, ',', '.') }}</p>
                    <p class="text-sm text-zinc-500">Pendapatan Bulan Ini</p>
                </div>
                <div class="bg-zinc-50 rounded-xl p-4 text-center hover:bg-zinc-100 transition-colors">
                    <p class="text-2xl font-bold text-zinc-900">{{ $newUsersThisMonth }}</p>
                    <p class="text-sm text-zinc-500">User Baru Bulan Ini</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart Defaults
            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#71717a';
            Chart.defaults.borderColor = '#f4f4f5';

            // Revenue Chart
            const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: {!! json_encode($revenueLabels) !!},
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: {!! json_encode($revenueData) !!},
                        backgroundColor: (context) => {
                            const ctx = context.chart.ctx;
                            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                            gradient.addColorStop(0,
                                'rgba(88, 111, 124, 0.2)'); // comfy-600 with opacity
                            gradient.addColorStop(1, 'rgba(88, 111, 124, 0)');
                            return gradient;
                        },
                        borderColor: '#586F7C', // comfy-600
                        borderWidth: 2,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#586F7C',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#FFFFFF',
                            titleColor: '#18181b', // zinc-900
                            bodyColor: '#52525b', // zinc-600
                            borderColor: '#e4e4e7', // zinc-200
                            borderWidth: 1,
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR'
                                        }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [4, 4]
                            },
                            ticks: {
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000).toFixed(0) + 'rb';
                                    }
                                    return 'Rp ' + value;
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Status Chart
            const ctxStatus = document.getElementById('statusChart').getContext('2d');
            const statusLabels = {!! json_encode($chartStatuses) !!};
            const statusCounts = {!! json_encode($statusCounts) !!};

            // Custom colors for statuses
            const statusColors = {
                'pending': '#f59e0b', // amber-500
                'paid': '#3b82f6', // blue-500
                'processing': '#a855f7', // purple-500
                'shipped': '#6366f1', // indigo-500
                'completed': '#10b981', // emerald-500
                'cancelled': '#ef4444', // red-500
            };

            const backgroundColors = statusLabels.map(status => statusColors[status] || '#71717a');

            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: statusLabels.map(s => s.charAt(0).toUpperCase() + s.slice(1)),
                    datasets: [{
                        data: statusCounts,
                        backgroundColor: backgroundColors,
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                boxWidth: 8
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        });
    </script>
@endsection
