<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ComfyApparel - Comfort Meets Style</title>

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

<body class="font-sans antialiased text-zinc-900 bg-white" x-data="{ scrolled: false }"
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
                    <span class="font-bold text-xl tracking-tight"
                        :class="scrolled ? 'text-comfy-800' : 'text-comfy-800 lg:text-white'">
                        ComfyApparel
                    </span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#home" class="text-sm font-medium hover:text-comfy-500 transition-colors"
                        :class="scrolled ? 'text-zinc-600' : 'text-zinc-800 lg:text-white lg:hover:text-comfy-200'">Home</a>
                    <a href="#categories" class="text-sm font-medium hover:text-comfy-500 transition-colors"
                        :class="scrolled ? 'text-zinc-600' : 'text-zinc-800 lg:text-white lg:hover:text-comfy-200'">Categories</a>
                    <a href="#products" class="text-sm font-medium hover:text-comfy-500 transition-colors"
                        :class="scrolled ? 'text-zinc-600' : 'text-zinc-800 lg:text-white lg:hover:text-comfy-200'">Products</a>
                    <a href="#about" class="text-sm font-medium hover:text-comfy-500 transition-colors"
                        :class="scrolled ? 'text-zinc-600' : 'text-zinc-800 lg:text-white lg:hover:text-comfy-200'">About
                        Us</a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-sm font-semibold transition-colors"
                        :class="scrolled ? 'text-comfy-800 hover:text-comfy-600' :
                            'text-comfy-800 lg:text-white lg:hover:text-comfy-200'">
                        Log in
                    </a>
                    <a href="{{ route('register') }}"
                        class="rounded-full px-5 py-2.5 text-sm font-semibold shadow-sm transition-all hover:scale-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2"
                        :class="scrolled ? 'bg-comfy-800 text-white hover:bg-comfy-800/90' :
                            'bg-white text-comfy-800 hover:bg-zinc-100'">
                        Sign Up
                    </a>
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

    <!-- Hero Section -->
    <div id="home" class="relative bg-zinc-900">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero-banner.png') }}" class="h-full w-full object-cover opacity-60"
                alt="Hero Banner">
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent"></div>
        </div>

        <div
            class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 sm:py-48 lg:py-56 h-screen max-h-[800px] flex items-center">
            <div class="max-w-2xl">
                <div class="hidden sm:mb-8 sm:flex sm:justify-start">
                </div>
                <h1 class="text-4xl font-serif font-bold tracking-tight text-white sm:text-6xl mb-6">
                    Redefine Your Everyday <br> <span class="text-comfy-200">Comfort & Style</span>
                </h1>
                <p class="mt-4 text-lg leading-8 text-zinc-300 mb-8">
                    Discover our sustainably crafted collection designed for those who value elegance in simplicity.
                    Premium linen, earth tones, and timeless cuts.
                </p>
                <div class="flex items-center gap-x-6">
                    <a href="#"
                        class="rounded-full bg-comfy-500 px-8 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-comfy-500/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-comfy-500 transition-all hover:scale-105">
                        Shop Collection
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <section id="categories" class="py-24 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center mb-16">
                <h2 class="text-3xl font-serif font-bold tracking-tight text-comfy-800 sm:text-4xl">Curated Categories
                </h2>
                <p class="mt-4 text-lg leading-8 text-zinc-600">Explore our most loved collections, handpicked for you.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
                @foreach ($kategoris as $kategori)
                    <div class="group relative">
                        <div
                            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-2xl bg-zinc-100 lg:aspect-none group-hover:opacity-75 lg:h-80 relative transition-all duration-300">
                            <!-- Placeholder Pattern since no image in DB -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-comfy-50 to-zinc-200 flex items-center justify-center">
                                <span class="text-9xl text-comfy-800/10 font-serif font-bold select-none">
                                    {{ substr($kategori->kategori, 0, 1) }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-zinc-900">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $kategori->kategori }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-zinc-500 line-clamp-2">
                                    {{ $kategori->deskripsi }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Latest Products -->
    <section id="products" class="py-24 bg-zinc-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center mb-16">
                <h2 class="text-3xl font-serif font-bold tracking-tight text-comfy-800 sm:text-4xl">Latest Collection
                </h2>
                <p class="mt-4 text-lg leading-8 text-zinc-600">Our newest arrivals, designed for the modern lifestyle.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($produks as $produk)
                    <div class="group relative">
                        <div
                            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-zinc-200 lg:aspect-none group-hover:opacity-75 lg:h-80 relative">
                            @if ($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}"
                                    class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                            @else
                                <div class="absolute inset-0 bg-white flex items-center justify-center text-zinc-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-10">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-zinc-900">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $produk->nama }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-zinc-500">
                                    {{ $produk->kategori->kategori ?? 'Uncategorized' }}</p>
                            </div>
                            <p class="text-sm font-medium text-comfy-800">Rp
                                {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-12 text-center">
                <a href="#"
                    class="inline-block rounded-full bg-comfy-800 px-8 py-3 text-sm font-semibold text-white shadow-sm hover:bg-comfy-800/90 transition-all hover:scale-105">View
                    All Products</a>
            </div>
        </div>
    </section>

    <!-- About Us -->
    <section id="about" class="bg-comfy-50 py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="text-comfy-800 font-bold uppercase tracking-widest text-sm">About Us</span>
                    <h2 class="mt-4 text-3xl font-serif font-bold tracking-tight text-zinc-900 sm:text-4xl">
                        Designed for Comfort, Crafted for You
                    </h2>
                    <p class="mt-6 text-lg text-zinc-600 leading-relaxed">
                        We believe that fashion shouldn't compromise on comfort. Our pieces are ethically made using
                        organic materials that feel good on your skin and are kind to the planet. Minimalist designs
                        that stand the test of time.
                    </p>

                    <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-zinc-600 lg:max-w-none">
                        <div class="relative pl-9">
                            <dt class="inline font-bold text-zinc-900">
                                <svg class="absolute left-1 top-1 h-5 w-5 text-comfy-800" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.5 17a4.5 4.5 0 01-1.44-8.765 4.5 4.5 0 018.302-3.046 3.5 3.5 0 014.504 4.272A4 4 0 0115 17H5.5zm3.75-2.75a.75.75 0 001.5 0V9.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0l-3.25 3.5a.75.75 0 101.1 1.02l1.95-2.1v4.59z"
                                        clip-rule="evenodd" />
                                </svg>
                                Sustainable Materials.
                            </dt>
                            <dd class="inline">Sourced responsibly to ensure minimal environmental impact.</dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="inline font-bold text-zinc-900">
                                <svg class="absolute left-1 top-1 h-5 w-5 text-comfy-800" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                        clip-rule="evenodd" />
                                </svg>
                                Ethical Production.
                            </dt>
                            <dd class="inline">We partner with factories that pay fair wages and ensure safe working
                                conditions.</dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="inline font-bold text-zinc-900">
                                <svg class="absolute left-1 top-1 h-5 w-5 text-comfy-800" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.16-1.1c-.31-.324-.786-.93-1.38-1.993C5.197 9.38 4.75 6.643 6.942 3.84c1.699-2.031 4.756-2.031 6.455 0 2.192 2.803 1.745 5.54 0 9.97-.591 1.062-1.068 1.668-1.38 1.992a20.801 20.801 0 01-1.176 1.11l-.018.01-.005.003h-.002a.75.75 0 01-.832 0h-.002z" />
                                </svg>
                                Local Design.
                            </dt>
                            <dd class="inline">Designed in-house to capture the essence of modern living.</dd>
                        </div>
                    </dl>
                </div>
                <div class="relative">
                    <img src="{{ asset('images/auth-bg.png') }}" alt="Sustainable Fashion"
                        class="rounded-2xl shadow-xl w-full object-cover h-[500px]">
                    <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-xl shadow-lg max-w-xs hidden md:block">
                        <p class="text-4xl font-bold text-comfy-800">100%</p>
                        <p class="text-sm font-medium text-zinc-500 uppercase tracking-wide mt-1">Organic Cotton</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-comfy-800 text-white" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-32">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8">
                    <div class="flex items-center gap-2">
                        <div class="bg-white text-comfy-800 p-1.5 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight">ComfyApparel</span>
                    </div>
                    <p class="text-sm leading-6 text-comfy-200">
                        Making the world a more comfortable place, one stitch at a time.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-white hover:text-comfy-200">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.484 2h.166zM12 7a5 5 0 100 10 5 5 0 000-10zm0 8a3 3 0 110-6 3 3 0 010 6zm5.338-3.205a1.2 1.2 0 110-2.4 1.2 1.2 0 010 2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-comfy-200">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6 text-white">Shop</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#" class="text-sm leading-6 text-comfy-200 hover:text-white">New
                                        Arrivals</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-comfy-200 hover:text-white">Tops</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-comfy-200 hover:text-white">Bottoms</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-comfy-200 hover:text-white">Accessories</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-sm font-semibold leading-6 text-white">Company</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#" class="text-sm leading-6 text-comfy-200 hover:text-white">About
                                        Us</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-comfy-200 hover:text-white">Sustainability</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-comfy-200 hover:text-white">Press</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6 text-white">Legal</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-comfy-200 hover:text-white">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm leading-6 text-comfy-200 hover:text-white">Terms
                                        of Service</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-16 border-t border-white/10 pt-8 sm:mt-20 lg:mt-24">
                <p class="text-xs leading-5 text-comfy-200">&copy; 2025 ComfyApparel, Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
