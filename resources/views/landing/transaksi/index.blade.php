@extends('layouts.landing')

@section('title', 'Riwayat Transaksi - ComfyApparel')
@section('body-class', 'bg-zinc-50')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-serif font-bold text-comfy-800 sm:text-4xl">Riwayat Transaksi</h1>
            <p class="mt-2 text-lg text-zinc-600">Kelola dan pantau semua pesanan Anda</p>
        </div>

        <!-- Transaksi List -->
        @if ($transaksis->count() > 0)
            <div class="space-y-6">
                @foreach ($transaksis as $transaksi)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-zinc-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <!-- Header Card -->
                        <div class="bg-comfy-50 px-6 py-4 border-b border-zinc-100">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <div>
                                    <h3 class="text-lg font-semibold text-comfy-800">{{ $transaksi->kode_transaksi }}</h3>
                                    <p class="text-sm text-zinc-600">{{ $transaksi->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    @php
                                        $statusClass = match ($transaksi->status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                            'paid' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'processing' => 'bg-purple-100 text-purple-800 border-purple-200',
                                            'shipped' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                                            'completed' => 'bg-green-100 text-green-800 border-green-200',
                                            'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                            default => 'bg-zinc-100 text-zinc-800 border-zinc-200',
                                        };
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium border {{ $statusClass }}">
                                        {{ ucfirst($transaksi->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Body Card -->
                        <div class="px-6 py-5">
                            <!-- Items -->
                            <div class="space-y-3 mb-4">
                                @foreach ($transaksi->details as $detail)
                                    <div class="flex items-center gap-4">
                                        <div class="flex-shrink-0 w-16 h-16 bg-zinc-100 rounded-lg"></div>
                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium text-zinc-900">{{ $detail->nama_produk }}</h4>
                                            <p class="text-sm text-zinc-500">{{ $detail->quantity }} × Rp
                                                {{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-semibold text-comfy-800">Rp
                                                {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Total -->
                            <div class="border-t border-zinc-100 pt-4 mt-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm text-zinc-600">Subtotal</span>
                                    <span class="text-sm text-zinc-900">Rp
                                        {{ number_format($transaksi->subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-sm text-zinc-600">Ongkir</span>
                                    <span class="text-sm text-zinc-900">Rp
                                        {{ number_format($transaksi->ongkir, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center pt-3 border-t border-zinc-200">
                                    <span class="text-base font-semibold text-zinc-900">Total</span>
                                    <span class="text-lg font-bold text-comfy-800">Rp
                                        {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Card -->
                        <div class="bg-zinc-50 px-6 py-4 flex gap-3 justify-end">
                            <a href="{{ route('transaksi.show', $transaksi->id) }}"
                                class="inline-flex items-center px-4 py-2 border border-comfy-800 rounded-lg text-sm font-medium text-comfy-800 hover:bg-comfy-50 transition-colors">
                                Lihat Detail
                            </a>
                            @if (in_array($transaksi->status, ['pending', 'paid']))
                                <form action="{{ route('transaksi.cancel', $transaksi->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-red-600 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-colors"
                                        onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                        Batalkan Pesanan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl border border-zinc-100 p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-zinc-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-lg font-semibold text-zinc-900 mb-2">Belum Ada Transaksi</h3>
                <p class="text-zinc-600 mb-6">Yuk mulai belanja produk favorit Anda!</p>
                <a href="{{ route('landing.produk') }}"
                    class="inline-flex items-center px-6 py-3 bg-comfy-800 text-white rounded-lg font-medium hover:bg-comfy-900 transition-colors">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
@endsection
