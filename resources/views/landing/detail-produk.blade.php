<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $produk->nama }} - ComfyApparel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,600;1,600&display=swap"
        rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased text-zinc-900 bg-white flex flex-col min-h-full" x-data="{ scrolled: false }"
    @scroll.window="scrolled = (window.pageYOffset > 20)">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300"
        :class="scrolled ? 'bg-white/90 backdrop-blur-md shadow-sm py-4' : 'bg-transparent py-6'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2 group">
                    <div
                        class="bg-comfy-800 text-white p-1.5 rounded-lg shadow-sm shadow-comfy-800/20 transition-transform group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-comfy-800">
                        ComfyApparel
                    </span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="/"
                        class="text-sm font-medium text-zinc-600 hover:text-comfy-800 transition-colors">Home</a>
                    <a href="{{ route('landing.produk') }}"
                        class="text-sm font-medium text-zinc-600 hover:text-comfy-800 transition-colors">Products</a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.outside="open = false"
                                class="flex items-center gap-2 focus:outline-none group">
                                <span class="text-sm font-semibold text-comfy-800 transition-colors">
                                    {{ Auth::user()->name }}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-4 text-zinc-600 transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 origin-top-right rounded-xl bg-white shadow-xl ring-1 ring-black/5 focus:outline-none py-1 z-50">
                                <a href="{{ route('dashboard') }}"
                                    class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 transition-colors">
                                    Dashboard
                                </a>
                                <div class="border-t border-zinc-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-semibold text-comfy-800 hover:text-comfy-600 transition-colors">
                            Log in
                        </a>
                        <a href="{{ route('register') }}"
                            class="rounded-full bg-comfy-800 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-comfy-800/90 transition-all hover:scale-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-32 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
                <!-- Product Image -->
                <div class="product-image-wrapper">
                    <div class="aspect-[4/5] w-full overflow-hidden rounded-2xl bg-zinc-100 relative group">
                        @if ($produk->gambar)
                            <img src="{{ Storage::url($produk->gambar) }}" alt="{{ $produk->nama }}"
                                class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center text-zinc-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-20">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </div>
                        @endif

                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                            @if ($produk->stok < 5 && $produk->stok > 0)
                                <span
                                    class="bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                    Low Stock
                                </span>
                            @endif
                            @if ($produk->created_at->diffInDays(now()) < 7)
                                <span
                                    class="bg-comfy-800 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                    New Arrival
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="mt-10 px-4 sm:mt-16 sm:px-0 lg:mt-0">
                    <!-- Category -->
                    <nav aria-label="Breadcrumb">
                        <ol role="list" class="flex items-center space-x-2">
                            <li>
                                <a href="{{ route('landing.produk') }}"
                                    class="text-sm text-zinc-500 hover:text-zinc-900 transition-colors">Products</a>
                            </li>
                            <li>
                                <svg class="h-5 w-5 flex-shrink-0 text-zinc-300" fill="currentColor" viewBox="0 0 20 20"
                                    aria-hidden="true">
                                    <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                                </svg>
                            </li>
                            <li>
                                <a href="{{ route('landing.produk', ['kategori' => $produk->kategori_id]) }}"
                                    class="text-sm text-zinc-500 hover:text-zinc-900 transition-colors">
                                    {{ $produk->kategori->kategori }}
                                </a>
                            </li>
                        </ol>
                    </nav>

                    <h1 class="mt-3 text-3xl font-bold tracking-tight text-zinc-900 font-serif sm:text-4xl">
                        {{ $produk->nama }}</h1>

                    <div class="mt-3">
                        <h2 class="sr-only">Product information</h2>
                        <p class="text-3xl tracking-tight text-comfy-800">Rp
                            {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Description</h3>
                        <div class="space-y-6 text-base text-zinc-600 leading-relaxed">
                            <p>{{ $produk->deskripsi }}</p>
                        </div>
                    </div>

                    <form class="mt-10" x-data="{
                        selectedSize: '',
                        selectedColor: '',
                        quantity: 1,
                        maxStock: {{ $produk->stok }}
                    }">
                        <!-- Sizes -->
                        @if ($produk->ukuran)
                            <div class="mt-8">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-medium text-zinc-900">Select Size</h3>
                                </div>

                                <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4 mt-4">
                                    @foreach (explode(',', $produk->ukuran) as $size)
                                        @php $size = trim($size); @endphp
                                        <label
                                            class="group relative flex items-center justify-center rounded-lg border py-3 px-4 text-sm font-medium uppercase hover:bg-zinc-50 focus:outline-none sm:flex-1 cursor-pointer transition-all shadow-sm"
                                            :class="selectedSize === '{{ $size }}' ?
                                                'border-transparent bg-comfy-800 text-white hover:bg-comfy-900 ring-2 ring-comfy-800 ring-offset-2' :
                                                'border-zinc-200 text-zinc-900 bg-white'">
                                            <input type="radio" name="size-choice" value="{{ $size }}"
                                                class="sr-only" x-model="selectedSize">
                                            <span
                                                id="size-choice-{{ $loop->index }}-label">{{ $size }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Colors -->
                        @if ($produk->warna)
                            <div class="mt-8">
                                <h3 class="text-sm font-medium text-zinc-900">Select Color</h3>
                                <div class="flex items-center space-x-3 mt-4">
                                    @foreach (explode(',', $produk->warna) as $color)
                                        @php $color = trim($color); @endphp
                                        <label
                                            class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none ring-comfy-800 transition-all"
                                            :class="selectedColor === '{{ $color }}' ? 'ring-2' : ''">
                                            <input type="radio" name="color-choice" value="{{ $color }}"
                                                class="sr-only" x-model="selectedColor">
                                            <span aria-hidden="true"
                                                class="h-8 w-8 rounded-full border border-black/10 transition-transform active:scale-95 flex items-center justify-center text-[10px] font-bold overflow-hidden bg-zinc-100 text-zinc-900">
                                                {{-- Simple color logic, ideally use proper hex codes mapped or just text --}}
                                                {{ substr($color, 0, 2) }}
                                            </span>
                                            <span class="sr-only">{{ $color }}</span>
                                            <!-- Tooltip could be added here -->
                                            <span
                                                class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-xs text-zinc-500 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">{{ $color }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <p class="mt-2 text-sm text-zinc-500" x-show="selectedColor"
                                    x-text="'Selected color: ' + selectedColor"></p>
                            </div>
                        @endif

                        <!-- Quantity & Add to Cart -->
                        <div class="mt-10 flex flex-col sm:flex-row gap-4">
                            <!-- Quantity -->
                            <div class="flex items-center border border-zinc-200 rounded-full w-max">
                                <button type="button"
                                    class="px-4 py-3 text-zinc-600 hover:text-comfy-800 transition-colors"
                                    @click="if(quantity > 1) quantity--">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                    </svg>
                                </button>
                                <span class="px-2 font-medium text-zinc-900 w-8 text-center" x-text="quantity"></span>
                                <button type="button"
                                    class="px-4 py-3 text-zinc-600 hover:text-comfy-800 transition-colors"
                                    @click="if(quantity < maxStock) quantity++">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </div>

                            <button type="button" :disabled="!selectedSize || !selectedColor || maxStock === 0"
                                class="flex-1 flex w-full items-center justify-center rounded-full border border-transparent bg-comfy-800 px-8 py-3 text-base font-medium text-white hover:bg-comfy-900 focus:outline-none focus:ring-2 focus:ring-comfy-800 focus:ring-offset-2 disabled:bg-zinc-300 disabled:cursor-not-allowed transition-all shadow-md hover:shadow-lg shadow-comfy-800/20 active:scale-95">
                                <span x-show="maxStock > 0">Add to Cart</span>
                                <span x-show="maxStock === 0">Out of Stock</span>
                            </button>
                        </div>

                        <p class="mt-4 text-sm text-zinc-500 text-center sm:text-left"
                            x-show="!selectedSize || !selectedColor">
                            Please select a size and color to continue.
                        </p>
                    </form>

                    <!-- Features -->
                    <div class="mt-10 border-t border-zinc-200 pt-10">
                        <div class="grid grid-cols-2 gap-x-4 gap-y-8">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-zinc-50 rounded-lg text-comfy-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-zinc-700">Free Shipping</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-zinc-50 rounded-lg text-comfy-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-zinc-700">Authentic</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if ($relatedProducts->count() > 0)
                <div class="mt-24">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold font-serif text-zinc-900">You Might Also Like</h2>
                        <a href="{{ route('landing.produk', ['kategori' => $produk->kategori_id]) }}"
                            class="text-sm font-medium text-comfy-800 hover:text-comfy-900 flex items-center gap-1 group">
                            See more
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor"
                                class="size-4 group-hover:translate-x-1 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        @foreach ($relatedProducts as $related)
                            <div
                                class="group relative bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col overflow-hidden border border-zinc-100">
                                <!-- Image -->
                                <div class="aspect-[4/5] w-full overflow-hidden bg-zinc-200 relative">
                                    @if ($related->gambar)
                                        <img src="{{ Storage::url($related->gambar) }}" alt="{{ $related->nama }}"
                                            class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <div
                                            class="absolute inset-0 bg-zinc-100 flex items-center justify-center text-zinc-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-12">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="p-5 flex-1 flex flex-col">
                                    <h3
                                        class="text-base font-bold text-zinc-900 mb-1 group-hover:text-comfy-800 transition-colors">
                                        <a href="{{ route('landing.detail', $related->id) }}">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            {{ $related->nama }}
                                        </a>
                                    </h3>
                                    <div class="mt-auto flex items-center justify-between">
                                        <p class="text-lg font-bold text-comfy-800">Rp
                                            {{ number_format($related->harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-comfy-800 text-white mt-auto">
        <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-2">
                    <div class="bg-white text-comfy-800 p-1.5 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight">ComfyApparel</span>
                </div>
                <p class="text-sm text-comfy-200">
                    &copy; 2025 ComfyApparel, Inc. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>
