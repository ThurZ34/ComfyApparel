@extends('layouts.landing')

@section('title', 'Invoice #' . $transaksi->kode_transaksi . ' - ComfyApparel')
@section('body-class', 'bg-zinc-50')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-serif font-bold text-comfy-800 sm:text-4xl">Invoice</h1>
                <p class="mt-2 text-lg text-zinc-600">{{ $transaksi->kode_transaksi }}</p>
            </div>
            <div>
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
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium border {{ $statusClass }}">
                    {{ ucfirst($transaksi->status) }}
                </span>
            </div>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            <!-- Informasi Transaksi -->
            <div class="bg-white rounded-2xl shadow-sm border border-zinc-100 overflow-hidden">
                <div class="bg-comfy-50 px-6 py-4 border-b border-zinc-100">
                    <h2 class="text-lg font-semibold text-comfy-800">Informasi Transaksi</h2>
                </div>
                <div class="px-6 py-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-zinc-600">Tanggal Pemesanan</p>
                            <p class="text-base font-medium text-zinc-900">
                                {{ $transaksi->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        @if ($transaksi->paid_at)
                            <div>
                                <p class="text-sm text-zinc-600">Tanggal Pembayaran</p>
                                <p class="text-base font-medium text-zinc-900">
                                    {{ $transaksi->paid_at->format('d M Y, H:i') }}</p>
                            </div>
                        @endif
                        @if ($transaksi->shipped_at)
                            <div>
                                <p class="text-sm text-zinc-600">Tanggal Pengiriman</p>
                                <p class="text-base font-medium text-zinc-900">
                                    {{ $transaksi->shipped_at->format('d M Y, H:i') }}</p>
                            </div>
                        @endif
                        @if ($transaksi->completed_at)
                            <div>
                                <p class="text-sm text-zinc-600">Tanggal Selesai</p>
                                <p class="text-base font-medium text-zinc-900">
                                    {{ $transaksi->completed_at->format('d M Y, H:i') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informasi Pengiriman -->
            <div class="bg-white rounded-2xl shadow-sm border border-zinc-100 overflow-hidden">
                <div class="bg-comfy-50 px-6 py-4 border-b border-zinc-100">
                    <h2 class="text-lg font-semibold text-comfy-800">Informasi Pengiriman</h2>
                </div>
                <div class="px-6 py-6">
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-zinc-600">Nama Penerima</p>
                            <p class="text-base font-medium text-zinc-900">{{ $transaksi->nama_penerima }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-600">No. Telepon</p>
                            <p class="text-base font-medium text-zinc-900">{{ $transaksi->no_telp_penerima }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-600">Alamat Pengiriman</p>
                            <p class="text-base font-medium text-zinc-900">{{ $transaksi->alamat_pengiriman }}</p>
                        </div>
                        @if ($transaksi->catatan)
                            <div>
                                <p class="text-sm text-zinc-600">Catatan</p>
                                <p class="text-base font-medium text-zinc-900">{{ $transaksi->catatan }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Detail Pesanan -->
            <div class="bg-white rounded-2xl shadow-sm border border-zinc-100 overflow-hidden">
                <div class="bg-comfy-50 px-6 py-4 border-b border-zinc-100">
                    <h2 class="text-lg font-semibold text-comfy-800">Detail Pesanan</h2>
                </div>
                <div class="px-6 py-6">
                    <div class="space-y-4">
                        @foreach ($transaksi->details as $detail)
                            <div class="flex items-center gap-4 pb-4 border-b border-zinc-100 last:border-0">
                                <!-- Product Image Placeholder -->
                                <div class="flex-shrink-0 w-20 h-20 bg-zinc-100 rounded-lg overflow-hidden">
                                    @if ($detail->produk && $detail->produk->gambar)
                                        <img src="{{ asset('storage/' . $detail->produk->gambar) }}"
                                            alt="{{ $detail->nama_produk }}" class="w-full h-full object-cover">
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1">
                                    <h4 class="text-base font-semibold text-zinc-900">{{ $detail->nama_produk }}</h4>
                                    <p class="text-sm text-zinc-600 mt-1">
                                        {{ $detail->quantity }} × Rp
                                        {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                    </p>
                                </div>

                                <!-- Subtotal -->
                                <div class="text-right">
                                    <p class="text-base font-semibold text-comfy-800">
                                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total Summary -->
                    <div class="mt-6 pt-6 border-t-2 border-zinc-200 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-zinc-600">Subtotal</span>
                            <span class="text-zinc-900 font-medium">Rp
                                {{ number_format($transaksi->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-zinc-600">Ongkos Kirim</span>
                            <span class="text-zinc-900 font-medium">Rp
                                {{ number_format($transaksi->ongkir, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-3 border-t border-zinc-200">
                            <span class="text-lg font-semibold text-zinc-900">Total</span>
                            <span class="text-2xl font-bold text-comfy-800">Rp
                                {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                <a href="{{ route('transaksi.index') }}"
                    class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-zinc-300 rounded-lg text-base font-medium text-zinc-700 bg-white hover:bg-zinc-50 transition-colors">
                    Kembali ke Riwayat
                </a>

                @if (in_array($transaksi->status, ['pending', 'paid']))
                    <form action="{{ route('transaksi.cancel', $transaksi->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full inline-flex justify-center items-center px-6 py-3 border border-red-600 rounded-lg text-base font-medium text-red-600 bg-white hover:bg-red-50 transition-colors"
                            onclick="return confirm('Yakin ingin membatalkan pesanan ini? Saldo akan dikembalikan.')">
                            Batalkan Pesanan
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
