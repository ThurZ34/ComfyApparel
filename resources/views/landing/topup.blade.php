@extends('layouts.landing')

@section('title', 'Top Up Saldo - ComfyApparel')
@section('nav-text-class-lg', 'lg:text-zinc-800')
@section('nav-hover-class-lg', 'lg:hover:text-comfy-600')
@section('nav-icon-class-lg', 'lg:text-zinc-600')

@section('content')
    <div class="bg-zinc-50 min-h-screen pb-20">
        <!-- Header Section -->
        <div class="bg-white shadow-sm border-b border-zinc-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <h1 class="text-3xl font-serif font-bold text-zinc-900">Dompet Saya</h1>
                <p class="mt-2 text-zinc-500">Kelola saldo dan riwayat transaksi anda.</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Top Up Form -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Balance Card -->
                    <div
                        class="bg-gradient-to-br from-comfy-900 to-comfy-700 rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>

                        <div class="relative z-10">
                            <p class="text-comfy-100 text-sm font-medium">Saldo Aktif Saat Ini</p>
                            <h2 class="text-4xl font-bold mt-2">Rp
                                {{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }}</h2>
                            <div class="mt-6 flex items-center gap-2 text-sm text-comfy-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                </svg>
                                <span>Akun Terverifikasi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Top Up Action -->
                    <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 p-6 md:p-8">
                        <h3 class="text-lg font-bold text-zinc-900 mb-6 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 text-comfy-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Isi Saldo
                        </h3>

                        <form action="{{ route('topup.store') }}" method="POST" x-data="{ selectedAmount: '' }">
                            @csrf
                            <div class="space-y-6">
                                <!-- Nominal Presets -->
                                <div>
                                    <label class="block text-sm font-medium text-zinc-700 mb-3">Pilih Nominal</label>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                        @foreach ([50000, 100000, 200000, 500000] as $amount)
                                            <button type="button" @click="selectedAmount = '{{ $amount }}'"
                                                :class="selectedAmount == '{{ $amount }}' ?
                                                    'bg-comfy-50 border-comfy-600 text-comfy-800 ring-1 ring-comfy-600' :
                                                    'bg-zinc-50 border-zinc-200 text-zinc-900 hover:bg-zinc-100'"
                                                class="rounded-xl border p-4 text-center transition-all focus:outline-none group relative overflow-hidden">
                                                <span class="block text-sm font-semibold relative z-10">Rp
                                                    {{ number_format($amount / 1000, 0) }}rb</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Custom Amount -->
                                <div>
                                    <label for="amount" class="block text-sm font-medium text-zinc-700 mb-2">Nominal Top
                                        Up</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <span class="text-zinc-500 sm:text-sm">Rp</span>
                                        </div>
                                        <input type="number" name="amount" id="custom_amount" min="10000"
                                            x-model="selectedAmount"
                                            class="block w-full rounded-lg border-0 py-3 pl-10 pr-12 text-zinc-900 ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-600 sm:text-sm sm:leading-6"
                                            placeholder="0" required>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <span class="text-zinc-500 sm:text-sm">IDR</span>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-xs text-zinc-500">Minimal top up Rp 10.000</p>
                                </div>

                                <!-- Submit -->
                                <button type="submit"
                                    class="w-full rounded-full bg-comfy-800 px-4 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-comfy-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-comfy-600 transition-all hover:scale-[1.01] active:scale-[0.99]">
                                    Lanjut Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column: History -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 p-6 h-full">
                        <h3 class="text-lg font-bold text-zinc-900 mb-6 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 text-comfy-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Riwayat Transaksi
                        </h3>

                        @if (isset($topup) && count($topup) > 0)
                            <div class="flow-root">
                                <ul role="list" class="-my-5 divide-y divide-zinc-100">
                                    @foreach ($topup as $item)
                                        <li class="py-4 hover:bg-zinc-50 transition-colors -mx-2 px-2 rounded-lg">
                                            <div class="flex items-center gap-x-3">
                                                <div
                                                    class="flex-none rounded-full p-2 {{ $item->status == 'success' ? 'bg-green-50 text-green-600' : ($item->status == 'pending' ? 'bg-yellow-50 text-yellow-600' : 'bg-red-50 text-red-600') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-4 h-4">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="flex-auto">
                                                    <p class="text-sm font-semibold leading-6 text-zinc-900">Top Up Saldo
                                                    </p>
                                                    <p class="text-xs leading-5 text-zinc-500">
                                                        {{ $item->created_at->format('d M Y, H:i') }}</p>
                                                </div>
                                                <div class="flex flex-col items-end">
                                                    <p class="text-sm font-bold leading-6 text-zinc-900">
                                                        +{{ number_format($item->amount, 0, ',', '.') }}</p>
                                                    <div class="mt-1 flex items-center gap-x-1.5">
                                                        <div
                                                            class="flex-none rounded-full {{ $item->status == 'success' ? 'bg-green-500/20' : ($item->status == 'pending' ? 'bg-yellow-500/20' : 'bg-red-500/20') }} p-1">
                                                            <div
                                                                class="h-1.5 w-1.5 rounded-full {{ $item->status == 'success' ? 'bg-green-500' : ($item->status == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                                                            </div>
                                                        </div>
                                                        <p class="text-xs leading-5 text-zinc-500 capitalize">
                                                            {{ $item->status }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-zinc-100 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 text-zinc-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-zinc-900">Belum ada transaksi</p>
                                <p class="text-xs text-zinc-500 mt-1">Riwayat top up anda akan muncul disini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
