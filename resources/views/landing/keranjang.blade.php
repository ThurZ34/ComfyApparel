@extends('layouts.landing')

@section('title', 'Shopping Cart - ComfyApparel')
@section('body-class', 'bg-zinc-50')

@section('main-wrapper')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-32">
        <h1 class="text-3xl font-serif font-bold text-zinc-900 mb-8">Your Shopping Cart</h1>

        <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start xl:gap-x-16">
            <!-- Cart Items -->
            <section class="lg:col-span-7">
                @if ($cartItems->count() > 0)
                    <ul role="list" class="divide-y divide-zinc-200 border-t border-b border-zinc-200">
                        @foreach ($cartItems as $item)
                            <li class="flex py-6 sm:py-10">
                                <div
                                    class="h-24 w-24 shrink-0 rounded-md border border-zinc-200 overflow-hidden sm:h-32 sm:w-32 bg-zinc-100 relative">
                                    @if ($item->gambar)
                                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama }}"
                                            class="h-full w-full object-cover object-center">
                                    @else
                                        <div class="flex items-center justify-center h-full w-full text-zinc-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                                    <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                        <div>
                                            <div class="flex justify-between">
                                                <h3 class="text-sm">
                                                    <a href="{{ route('landing.detail', $item->id) }}"
                                                        class="font-medium text-zinc-700 hover:text-comfy-800 transition-colors">
                                                        {{ $item->nama }}
                                                    </a>
                                                </h3>
                                            </div>
                                            <div class="mt-1 flex text-sm">
                                                <p class="text-zinc-500 border-r border-zinc-200 pr-2 mr-2">
                                                    {{ $item->selected_color }}</p>
                                                <p class="text-zinc-500">{{ $item->selected_size }}</p>
                                            </div>
                                            <p class="mt-1 text-sm font-medium text-comfy-800">Rp
                                                {{ number_format($item->harga, 0, ',', '.') }}</p>
                                        </div>

                                        <div class="mt-4 sm:mt-0 sm:pr-9">
                                            <div class="flex items-center border border-zinc-300 rounded-md w-max">
                                                <button type="button"
                                                    class="px-2 py-1 text-zinc-600 hover:bg-zinc-50 rounded-l-md">
                                                    -
                                                </button>
                                                <input type="text" name="quantity" value="{{ $item->quantity }}"
                                                    class="w-8 border-0 p-0 text-center text-zinc-900 focus:ring-0 text-sm bg-transparent"
                                                    readonly>
                                                <button type="button"
                                                    class="px-2 py-1 text-zinc-600 hover:bg-zinc-50 rounded-r-md">
                                                    +
                                                </button>
                                            </div>

                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                                                class="absolute top-0 right-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="-m-2 inline-flex p-2 text-zinc-400 hover:text-red-500 transition-colors">
                                                    <span class="sr-only">Remove</span>
                                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-12 bg-white rounded-lg border border-zinc-200 border-dashed">
                        <svg class="mx-auto h-12 w-12 text-zinc-300" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-zinc-900">Your cart is empty</h3>
                        <p class="mt-1 text-sm text-zinc-500">Start adding some items to fill it up.</p>
                        <div class="mt-6">
                            <a href="{{ route('landing.produk') }}"
                                class="inline-flex items-center rounded-md border border-transparent bg-comfy-800 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-comfy-900 focus:outline-none focus:ring-2 focus:ring-comfy-500 focus:ring-offset-2">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                @endif
            </section>

            <!-- Order Summary -->
            @if ($cartItems->count() > 0)
                <section
                    class="mt-16 rounded-xl bg-zinc-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8 border border-zinc-100">
                    <h2 class="text-lg font-medium text-zinc-900" id="summary-heading">Order summary</h2>

                    <dl class="mt-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-zinc-600">Subtotal</dt>
                            <dd class="text-sm font-medium text-zinc-900">Rp
                                {{ number_format($cartItems->sum(fn($i) => $i->harga * $i->quantity), 0, ',', '.') }}
                            </dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-zinc-200 pt-4">
                            <dt class="flex items-center text-sm text-zinc-600">
                                <span>Shipping estimate</span>
                                <a href="#" class="ml-2 flex-shrink-0 text-zinc-400 hover:text-zinc-500">
                                    <span class="sr-only">Learn more about how shipping is calculated</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM8.94 6.94a.75.75 0 11-1.061-1.061 3 3 0 112.871 5.026v.345a.75.75 0 01-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 108.94 6.94zM10 15a1 1 0 100-2 1 1 0 000 2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </dt>
                            <dd class="text-sm font-medium text-zinc-900">Calculated at checkout</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-zinc-200 pt-4">
                            <dt class="text-base font-medium text-zinc-900">Order total</dt>
                            <dd class="text-base font-medium text-zinc-900">Rp
                                {{ number_format($cartItems->sum(fn($i) => $i->harga * $i->quantity), 0, ',', '.') }}
                            </dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <a href="{{ route('transaksi.create') }}"
                            class="block w-full text-center rounded-full border border-transparent bg-comfy-800 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-comfy-900 focus:outline-none focus:ring-2 focus:ring-comfy-500 focus:ring-offset-2 focus:ring-offset-gray-50 transition-all shadow-comfy-800/20 hover:shadow-lg">
                            Checkout
                        </a>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="{{ route('landing.produk') }}"
                            class="text-sm font-medium text-comfy-800 hover:text-comfy-600">
                            or Continue Shopping
                            <span aria-hidden="true"> &rarr;</span>
                        </a>
                    </div>
                </section>
            @endif
        </div>
    </div>
@endsection
