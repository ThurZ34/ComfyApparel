<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Our Collection - ComfyApparel</title>

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

<body class="font-sans antialiased text-zinc-900 bg-zinc-50 flex flex-col min-h-full" x-data="{ scrolled: false }"
    @scroll.window="scrolled = (window.pageYOffset > 20)">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/90 backdrop-blur-md shadow-sm py-4">
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
                    <a href="/#categories"
                        class="text-sm font-medium text-zinc-600 hover:text-comfy-800 transition-colors">Categories</a>
                    <a href="{{ route('landing.produk') }}"
                        class="text-sm font-medium text-comfy-800 transition-colors">Products</a>
                    <a href="/#about"
                        class="text-sm font-medium text-zinc-600 hover:text-comfy-800 transition-colors">About Us</a>
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

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="text-zinc-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="pt-32 pb-12 bg-white border-b border-zinc-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-serif font-bold text-comfy-800 sm:text-5xl">Shop Collection</h1>
            <p class="mt-4 text-lg text-zinc-500 max-w-2xl mx-auto">Explore our carefully curated selection of premium
                apparel. Designed for comfort, styled for life.</p>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Filters & Sort (Visual Placeholder) -->
            <div
                class="flex flex-col sm:flex-row justify-between items-center mb-10 pb-6 border-b border-zinc-200 gap-4">
                <div class="flex items-center gap-2 overflow-x-auto w-full sm:w-auto pb-2 sm:pb-0">
                    <a href="{{ route('landing.produk', ['sort' => request('sort')]) }}"
                        class="px-4 py-2 rounded-full {{ !request('kategori') ? 'bg-comfy-800 text-white' : 'bg-white border border-zinc-200 text-zinc-600 hover:border-comfy-800 hover:text-comfy-800' }} text-sm font-medium whitespace-nowrap transition-colors">
                        All Items
                    </a>

                    @foreach ($kategoris as $cat)
                        <a href="{{ route('landing.produk', ['kategori' => $cat->id, 'sort' => request('sort')]) }}"
                            class="px-4 py-2 rounded-full {{ request('kategori') == $cat->id ? 'bg-comfy-800 text-white' : 'bg-white border border-zinc-200 text-zinc-600 hover:border-comfy-800 hover:text-comfy-800' }} text-sm font-medium whitespace-nowrap transition-colors">
                            {{ $cat->kategori }}
                        </a>
                    @endforeach
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-zinc-500">Sort by:</span>
                    <form action="{{ route('landing.produk') }}" method="GET">
                        @if (request('kategori'))
                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        @endif
                        <select name="sort" onchange="this.form.submit()"
                            class="text-sm border-zinc-200 rounded-lg focus:ring-comfy-800 focus:border-comfy-800 text-zinc-700">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals
                            </option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price:
                                Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price:
                                High to Low</option>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            @if ($produks->count() > 0)
                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach ($produks as $produk)
                        <div
                            class="group relative bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col overflow-hidden border border-zinc-100">
                            <!-- Image -->
                            <div class="aspect-[4/5] w-full overflow-hidden bg-zinc-200 relative">
                                @if ($produk->gambar)
                                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}"
                                        class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div
                                        class="absolute inset-0 bg-zinc-100 flex items-center justify-center text-zinc-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-12">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </div>
                                @endif

                                <!-- Floating Badge -->
                                @if ($produk->stok < 5 && $produk->stok > 0)
                                    <div
                                        class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                        Low Stock
                                    </div>
                                @endif
                                @if ($produk->created_at->diffInDays(now()) < 7)
                                    <div
                                        class="absolute top-3 right-3 bg-comfy-800 text-white text-xs font-bold px-2 py-1 rounded">
                                        New
                                    </div>
                                @endif

                                <!-- Quick Action Overlay -->
                                <div
                                    class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300 flex justify-center">
                                    <button
                                        class="bg-white text-comfy-800 px-6 py-2 rounded-full shadow-lg font-medium text-sm hover:bg-comfy-50 transition-colors flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                        </svg>
                                        Add to Cart
                                    </button>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex-1 flex flex-col">
                                <p class="text-xs text-zinc-500 mb-1">
                                    {{ $produk->kategori->kategori ?? 'Collection' }}</p>
                                <h3
                                    class="text-base font-bold text-zinc-900 mb-1 group-hover:text-comfy-800 transition-colors">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $produk->nama }}
                                    </a>
                                </h3>
                                <p class="text-sm text-zinc-500 line-clamp-2 mb-4 flex-1">{{ $produk->deskripsi }}</p>
                                <div class="mt-auto flex items-center justify-between">
                                    <p class="text-lg font-bold text-comfy-800">Rp
                                        {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $produks->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="mx-auto h-12 w-12 text-zinc-300" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-zinc-900">No products found</h3>
                    <p class="mt-1 text-sm text-zinc-500">Check back later for new arrivals.</p>
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
                <div class="flex space-x-6">
                    <a href="#" class="text-white hover:text-comfy-200 transition-colors">Instagram</a>
                    <a href="#" class="text-white hover:text-comfy-200 transition-colors">Twitter</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
