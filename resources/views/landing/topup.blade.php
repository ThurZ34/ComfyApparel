@extends('layouts.landing')

@section('title', 'Top Up Saldo - ComfyApparel')
@section('body-class', 'bg-zinc-50')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-serif font-bold text-comfy-800 sm:text-4xl">Top Up Saldo</h1>
            <p class="mt-4 text-lg text-zinc-600">Tambah saldo dompet digitalmu untuk kemudahan berbelanja.</p>
        </div>

        {{-- Flash Messages --}}
        @if (session('error'))
            <div class="mb-6 rounded-lg bg-red-50 p-4 text-sm text-red-800 border border-red-200">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-800 border border-green-200">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('info'))
            <div class="mb-6 rounded-lg bg-blue-50 p-4 text-sm text-blue-800 border border-blue-200">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <span>{{ session('info') }}</span>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-zinc-100 overflow-hidden" x-data="{ amount: '' }">
            <div class="p-8 sm:p-12">
                {{-- Form POST to topup.store --}}
                <form action="{{ route('topup.store') }}" method="POST">
                    @csrf

                    <div class="mb-8">
                        <label for="amount" class="block text-sm font-medium leading-6 text-zinc-900 mb-2">Nominal Top
                            Up</label>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-zinc-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="amount" id="amount" x-model="amount"
                                class="block w-full rounded-md border-0 py-4 pl-12 pr-4 text-zinc-900 ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-xl sm:leading-6"
                                placeholder="0" min="10000" required>
                        </div>
                        <p class="mt-2 text-sm text-zinc-500">Minimal top up Rp 10.000</p>
                    </div>

                    <div class="mb-10">
                        <span class="block text-sm font-medium leading-6 text-zinc-900 mb-4">Pilih Nominal Cepat</span>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach ([50000, 100000, 250000, 500000] as $preset)
                                <button type="button" @click="amount = {{ $preset }}"
                                    :class="amount == {{ $preset }} ? 'bg-comfy-800 text-white ring-comfy-800' :
                                        'bg-white text-zinc-900 ring-zinc-200 hover:bg-zinc-50'"
                                    class="rounded-lg py-3 px-4 text-sm font-semibold shadow-sm ring-1 ring-inset transition-all">
                                    Rp {{ number_format($preset, 0, ',', '.') }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div
                        class="bg-zinc-50 -mx-8 -mb-12 px-8 py-6 flex items-center justify-between mt-8 border-t border-zinc-100 sm:-mx-12 sm:px-12">
                        <div class="flex items-center gap-2 text-sm text-zinc-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 text-green-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Pembayaran Aman & Terenkripsi</span>
                        </div>
                        <button type="submit"
                            class="rounded-full bg-comfy-800 px-8 py-3 text-sm font-semibold text-white shadow-sm hover:bg-comfy-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-comfy-800 transition-transform hover:scale-105">
                            Lanjutkan Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Info Section --}}
        <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-3">
            <div
                class="flex flex-col items-center text-center p-6 bg-white rounded-xl shadow-sm border border-zinc-50 hover:shadow-md transition-shadow">
                <div class="p-3 bg-comfy-50 rounded-full text-comfy-800 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-zinc-900">Proses Instan</h3>
                <p class="mt-2 text-sm text-zinc-500">Saldo akan masuk ke akunmu secara otomatis setelah pembayaran
                    terverifikasi.</p>
            </div>
            <div
                class="flex flex-col items-center text-center p-6 bg-white rounded-xl shadow-sm border border-zinc-50 hover:shadow-md transition-shadow">
                <div class="p-3 bg-comfy-50 rounded-full text-comfy-800 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.749 3.749 0 01-3.296-1.043 3.749 3.749 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-zinc-900">Terpercaya</h3>
                <p class="mt-2 text-sm text-zinc-500">Transaksi dilindungi dengan sistem keamanan standar industri.</p>
            </div>
            <div
                class="flex flex-col items-center text-center p-6 bg-white rounded-xl shadow-sm border border-zinc-50 hover:shadow-md transition-shadow">
                <div class="p-3 bg-comfy-50 rounded-full text-comfy-800 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V4.505c0-.986.993-1.638 1.902-1.383 2.181.61 5.397 2.457 7.078 6.942.338.904-.37 1.848-1.282 2.172l-1.07.382z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-zinc-900">Beragam Metode</h3>
                <p class="mt-2 text-sm text-zinc-500">Dukung pembayaran via transfer bank, e-wallet, dan QRIS.</p>
            </div>
        </div>

        {{-- Topup History --}}
        <div class="mt-16">
            <h2 class="text-2xl font-serif font-bold text-comfy-800 mb-6">Riwayat Top Up</h2>
            <div class="bg-white rounded-xl shadow-sm border border-zinc-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-zinc-600">
                        <thead class="bg-zinc-50 border-b border-zinc-100 text-xs uppercase font-semibold text-zinc-500">
                            <tr>
                                <th class="px-6 py-4">Tanggal Request</th>
                                <th class="px-6 py-4">Order ID</th>
                                <th class="px-6 py-4">Nominal</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Tanggal Persetujuan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100">
                            @forelse ($history as $item)
                                <tr class="hover:bg-zinc-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $item->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 font-mono text-xs">
                                        {{ $item->order_id }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-zinc-900">
                                        Rp {{ number_format($item->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($item->status === 'success')
                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                                <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                                Berhasil
                                            </span>
                                        @elseif ($item->status === 'pending')
                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
                                                <span class="h-1.5 w-1.5 rounded-full bg-yellow-600"></span>
                                                Pending
                                            </span>
                                        @elseif ($item->status === 'failed')
                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">
                                                <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                                Gagal
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-zinc-500">
                                        @if ($item->approved_at)
                                            {{ \Carbon\Carbon::parse($item->approved_at)->format('d M Y H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-zinc-500 italic">
                                        Belum ada riwayat top up.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
