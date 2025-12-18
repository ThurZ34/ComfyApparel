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

        <!-- Flash Messages -->
        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if (session('success'))
            <div
                class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Warning: Saldo Tidak Mencukupi -->
        @if (Auth::user()->balance < $subtotal)
            <div class="mb-6 bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-4 rounded-lg">
                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500 shrink-0 mt-0.5"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <div class="flex-1">
                        <h3 class="font-semibold text-yellow-900">Saldo Anda Tidak Mencukupi!</h3>
                        <p class="mt-1 text-sm text-yellow-700">
                            Total belanja Anda adalah <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>,
                            tetapi saldo Anda hanya <strong>Rp
                                {{ number_format(Auth::user()->balance, 0, ',', '.') }}</strong>.
                        </p>
                        <p class="mt-1 text-sm text-yellow-700">
                            Kekurangan: <strong class="text-red-600">Rp
                                {{ number_format($subtotal - Auth::user()->balance, 0, ',', '.') }}</strong>
                        </p>
                        <a href="{{ route('topup.index') }}"
                            class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded-lg hover:bg-yellow-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                <path fill-rule="evenodd"
                                    d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            Top Up Saldo Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @endif

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
                            class="block w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-base p-4">
                    </div>

                    <!-- No Telepon -->
                    <div>
                        <label for="no_telp_penerima" class="block text-sm font-medium text-zinc-900 mb-2">
                            No. Telepon
                        </label>
                        <input type="tel" name="no_telp_penerima" id="no_telp_penerima" required
                            value="{{ old('no_telp_penerima', Auth::user()->phone) }}"
                            class="block w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-base p-4">
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat_pengiriman" class="block text-sm font-medium text-zinc-900 mb-2">
                            Alamat Lengkap
                        </label>
                        <textarea name="alamat_pengiriman" id="alamat_pengiriman" rows="3" required
                            class="block w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-base p-4">{{ old('alamat_pengiriman', Auth::user()->address) }}</textarea>
                    </div>

                    <!-- Catatan -->
                    <div>
                        <label for="catatan" class="block text-sm font-medium text-zinc-900 mb-2">
                            Catatan (Opsional)
                        </label>
                        <textarea name="catatan" id="catatan" rows="2"
                            class="block w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-base p-4"
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
                @if (Auth::user()->balance >= $subtotal)
                    <button type="submit"
                        class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-lg text-base font-medium text-white bg-comfy-800 hover:bg-comfy-900 shadow-sm transition-colors">
                        Bayar Sekarang
                    </button>
                @else
                    <button type="button" disabled
                        class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-lg text-base font-medium text-white bg-zinc-400 cursor-not-allowed">
                        Saldo Tidak Mencukupi
                    </button>
                @endif
            </div>
        </form>
    </div>
@endsection
