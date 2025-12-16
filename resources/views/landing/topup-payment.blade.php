@extends('layouts.landing')

@section('title', 'Konfirmasi Pembayaran - ComfyApparel')
@section('body-class', 'bg-zinc-50')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-serif font-bold text-comfy-800 sm:text-4xl">Konfirmasi Pembayaran</h1>
            <p class="mt-4 text-lg text-zinc-600">Selesaikan pembayaran untuk menambah saldo.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-zinc-100 overflow-hidden p-8">
            {{-- Order Summary --}}
            <div class="border-b border-zinc-100 pb-6 mb-6">
                <h2 class="text-lg font-semibold text-zinc-900 mb-4">Ringkasan Pesanan</h2>
                <div class="flex justify-between items-center">
                    <span class="text-zinc-600">Order ID</span>
                    <span class="font-mono text-sm text-zinc-800">{{ $topup->order_id }}</span>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-zinc-600">Nominal Top Up</span>
                    <span class="text-xl font-bold text-comfy-800">Rp
                        {{ number_format($topup->amount, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Payment Button --}}
            <div class="text-center">
                <button id="pay-button"
                    class="w-full rounded-full bg-comfy-800 px-8 py-4 text-base font-semibold text-white shadow-sm hover:bg-comfy-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-comfy-800 transition-transform hover:scale-105">
                    <span class="flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                        Bayar Sekarang
                    </span>
                </button>
                <p class="mt-4 text-sm text-zinc-500">Klik tombol di atas untuk memilih metode pembayaran.</p>
            </div>

            {{-- Security Note --}}
            <div class="mt-8 pt-6 border-t border-zinc-100">
                <div class="flex items-center justify-center gap-2 text-sm text-zinc-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 text-green-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                    <span>Pembayaran diproses dengan aman oleh Midtrans</span>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('topup.index') }}" class="text-sm font-medium text-comfy-800 hover:text-comfy-600">
                &larr; Kembali ke halaman Top Up
            </a>
        </div>
    </div>

    {{-- Midtrans Snap JS --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    console.log('success', result);
                    window.location.href =
                    '{{ route('topup.finish') }}?order_id={{ $topup->order_id }}';
                },
                onPending: function(result) {
                    console.log('pending', result);
                    window.location.href =
                    '{{ route('topup.finish') }}?order_id={{ $topup->order_id }}';
                },
                onError: function(result) {
                    console.log('error', result);
                    alert('Pembayaran gagal!');
                },
                onClose: function() {
                    console.log('customer closed the popup without finishing the payment');
                }
            });
        });
    </script>
@endsection
