@extends('layouts.landing')

@section('title', 'Checkout - ComfyApparel')
@section('body-class', 'bg-zinc-50')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-serif font-bold text-comfy-800 sm:text-4xl">Checkout</h1>
            <p class="mt-2 text-lg text-zinc-600">Lengkapi data pengiriman Anda</p>
        </div>

        <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Informasi Pengiriman -->
            <div class="bg-white rounded-2xl shadow-sm border border-zinc-100 overflow-hidden">
                <div class="bg-comfy-50 px-6 py-4 border-b border-zinc-100">
                    <h2 class="text-lg font-semibold text-comfy-800">Informasi Pengiriman</h2>
                </div>
                <div class="px-6 py-6 space-y-4">
                    <!-- Nama Penerima -->
                    <div>
                        <label for="nama_penerima" class="block text-sm font-medium text-zinc-900 mb-2">
                            Nama Penerima
                        </label>
                        <input type="text" name="nama_penerima" id="nama_penerima" required
                            value="{{ old('nama_penerima', Auth::user()->name) }}"
                            class="block w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 sm:text-sm">
                    </div>

                    <!-- No Telepon -->
                    <div>
                        <label for="no_telp_penerima" class="block text-sm font-medium text-zinc-900 mb-2">
                            No. Telepon
                        </label>
                        <input type="tel" name="no_telp_penerima" id="no_telp_penerima" required
                            value="{{ old('no_telp_penerima', Auth::user()->phone) }}"
                            class="block w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 sm:text-sm">
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat_pengiriman" class="block text-sm font-medium text-zinc-900 mb-2">
                            Alamat Lengkap
                        </label>
                        <textarea name="alamat_pengiriman" id="alamat_pengiriman" rows="3" required
                            class="block w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 sm:text-sm">{{ old('alamat_pengiriman', Auth::user()->address) }}</textarea>
                    </div>

                    <!-- Catatan -->
                    <div>
                        <label for="catatan" class="block text-sm font-medium text-zinc-900 mb-2">
                            Catatan (Opsional)
                        </label>
                        <textarea name="catatan" id="catatan" rows="2"
                            class="block w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 sm:text-sm"
                            placeholder="Contoh: Kirim pagi hari">{{ old('catatan') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="bg-white rounded-2xl shadow-sm border border-zinc-100 overflow-hidden">
                <div class="bg-comfy-50 px-6 py-4 border-b border-zinc-100">
                    <h2 class="text-lg font-semibold text-comfy-800">Ringkasan Pesanan</h2>
                </div>
                <div class="px-6 py-6">
                    <!-- Cart Items -->
                    <div class="space-y-4 mb-6">
                        @foreach ($cartItems as $item)
                            <div class="flex items-center gap-4 pb-4 border-b border-zinc-100 last:border-0">
                                <!-- Product Image -->
                                <div class="shrink-0 w-16 h-16 bg-zinc-100 rounded-lg overflow-hidden">
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}"
                                            class="w-full h-full object-cover">
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1">
                                    <h4 class="text-sm font-semibold text-zinc-900">{{ $item->nama }}</h4>
                                    <p class="text-xs text-zinc-500 mt-1">
                                        {{ $item->selected_color }} · {{ $item->selected_size }}
                                    </p>
                                    <p class="text-xs text-zinc-600 mt-1">
                                        {{ $item->quantity }} × Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </p>
                                </div>

                                <!-- Subtotal -->
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-comfy-800">
                                        Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total Summary -->
                    <div class="pt-4 border-t-2 border-zinc-200 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-zinc-600">Subtotal</span>
                            <span class="text-zinc-900 font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-zinc-600">Ongkos Kirim</span>
                            <span class="text-zinc-900 font-medium">Rp 0</span>
                        </div>
                        <div class="flex justify-between items-center pt-3 border-t border-zinc-200">
                            <span class="text-base font-semibold text-zinc-900">Total</span>
                            <span class="text-xl font-bold text-comfy-800">Rp
                                {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Saldo Info -->
            <div class="bg-comfy-50 rounded-2xl border border-comfy-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-zinc-600">Saldo Anda Saat Ini</p>
                        <p class="text-2xl font-bold text-comfy-800">Rp
                            {{ number_format(Auth::user()->balance, 0, ',', '.') }}</p>
                    </div>
                    <a href="{{ route('topup.index') }}"
                        class="text-sm font-medium text-comfy-800 hover:text-comfy-900 underline">
                        Top Up Saldo
                    </a>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex gap-4">
                <a href="{{ route('landing.keranjang') }}"
                    class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-zinc-300 rounded-lg text-base font-medium text-zinc-700 bg-white hover:bg-zinc-50 transition-colors">
                    Kembali ke Keranjang
                </a>
                <button type="submit"
                    class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-lg text-base font-medium text-white bg-comfy-800 hover:bg-comfy-900 shadow-sm transition-colors">
                    Bayar Sekarang
                </button>
            </div>
        </form>
    </div>
@endsection
