@extends('layouts.app')

@section('header')
    Laporan Penjualan
@endsection

@section('content')
    <div class="space-y-6">
        <!-- Filter Section -->
        <div class="bg-white p-4 rounded-xl shadow-sm border border-zinc-200">
            <form action="{{ route('laporan.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
                <!-- Quick Filter -->
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-1">Periode</label>
                    <select name="filter" id="filterSelect" onchange="toggleCustomDate()"
                        class="block w-48 py-2 px-3 border border-zinc-200 bg-white rounded-lg focus:ring-comfy-800 focus:border-comfy-800 sm:text-sm">
                        <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="7_days" {{ $filter == '7_days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                        <option value="30_days" {{ $filter == '30_days' ? 'selected' : '' }}>30 Hari Terakhir</option>
                        <option value="this_month" {{ $filter == 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="custom" {{ $filter == 'custom' ? 'selected' : '' }}>Custom Range</option>
                    </select>
                </div>

                <!-- Custom Date Range -->
                <div id="customDateContainer" class="{{ $filter == 'custom' ? '' : 'hidden' }} flex items-end gap-2">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-1">Dari</label>
                        <input type="date" name="start_date"
                            value="{{ request('start_date', $startDate->format('Y-m-d')) }}"
                            class="block py-2 px-3 border border-zinc-200 rounded-lg focus:ring-comfy-800 focus:border-comfy-800 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-1">Sampai</label>
                        <input type="date" name="end_date" value="{{ request('end_date', $endDate->format('Y-m-d')) }}"
                            class="block py-2 px-3 border border-zinc-200 rounded-lg focus:ring-comfy-800 focus:border-comfy-800 sm:text-sm">
                    </div>
                </div>

                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-comfy-800 hover:bg-comfy-900">
                    Terapkan Filter
                </button>
            </form>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Transaksi -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-zinc-500">Total Transaksi</p>
                        <p class="text-3xl font-bold text-zinc-900 mt-1">{{ number_format($summary->total_transaksi ?? 0) }}
                        </p>
                        <p class="text-xs text-zinc-400 mt-1">{{ $filterLabel }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Penjualan -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-zinc-500">Total Penjualan</p>
                        <p class="text-3xl font-bold text-zinc-900 mt-1">Rp
                            {{ number_format($summary->total_penjualan ?? 0, 0, ',', '.') }}</p>
                        <p class="text-xs text-zinc-400 mt-1">Nilai produk terjual</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Pendapatan -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-zinc-500">Total Pendapatan</p>
                        <p class="text-3xl font-bold text-comfy-800 mt-1">Rp
                            {{ number_format($summary->total_pendapatan ?? 0, 0, ',', '.') }}</p>
                        <p class="text-xs text-zinc-400 mt-1">Termasuk ongkir</p>
                    </div>
                    <div class="p-3 bg-comfy-100 rounded-full">
                        <svg class="h-6 w-6 text-comfy-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Transaksi Table -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="px-6 py-4 bg-zinc-50 border-b border-zinc-200">
                    <h3 class="text-lg font-medium text-zinc-900">Daftar Transaksi</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead class="bg-zinc-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Pembeli</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-200">
                            @forelse($transaksis as $item)
                                <tr class="hover:bg-zinc-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900">
                                        {{ $item->kode_transaksi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">{{ $item->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-comfy-800">Rp
                                        {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClass = match ($item->status) {
                                                'completed' => 'bg-green-100 text-green-800',
                                                'shipped' => 'bg-indigo-100 text-indigo-800',
                                                'processing' => 'bg-purple-100 text-purple-800',
                                                'paid' => 'bg-blue-100 text-blue-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                                default => 'bg-yellow-100 text-yellow-800',
                                            };
                                        @endphp
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full {{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                        {{ $item->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-zinc-500">Tidak ada transaksi dalam
                                        periode ini</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="bg-white px-4 py-3 border-t border-zinc-200">
                    {{ $transaksis->links() }}
                </div>
            </div>

            <!-- Top Products -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="px-6 py-4 bg-zinc-50 border-b border-zinc-200">
                    <h3 class="text-lg font-medium text-zinc-900">Produk Terlaris</h3>
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
                                <p class="text-xs text-zinc-500">{{ $product->total_qty }} terjual</p>
                            </div>
                            <p class="text-sm font-semibold text-comfy-800">Rp
                                {{ number_format($product->total_revenue, 0, ',', '.') }}</p>
                        </div>
                    @empty
                        <p class="text-center text-zinc-500 py-8">Belum ada data</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function toggleCustomDate() {
                const filter = document.getElementById('filterSelect').value;
                const container = document.getElementById('customDateContainer');
                if (filter === 'custom') {
                    container.classList.remove('hidden');
                } else {
                    container.classList.add('hidden');
                }
            }
        </script>
    @endpush
@endsection
