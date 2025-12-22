@extends('layouts.landing')

@section('title', 'ComfyApparel - Comfort Meets Style')
@section('nav-text-class-lg', 'lg:text-white')
@section('nav-hover-class-lg', 'lg:hover:text-comfy-200')
@section('nav-icon-class-lg', 'lg:text-zinc-300')

@section('main-wrapper')

    <!-- Hero Section -->
    <div id="home" class="relative bg-zinc-900">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero-banner.png') }}" class="h-full w-full object-cover opacity-60" alt="Hero Banner">
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
                    <div
                        class="group relative flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm border border-zinc-100 hover:shadow-md transition-all duration-300">
                        <div class="aspect-[4/3] bg-zinc-200 sm:aspect-[3/2] lg:aspect-[4/3] relative overflow-hidden">
                            @if ($kategori->gambar_terbaru)
                                <img src="{{ Str::startsWith($kategori->gambar_terbaru, ['http://', 'https://']) ? $kategori->gambar_terbaru : asset('storage/' . $kategori->gambar_terbaru) }}"
                                    alt="{{ $kategori->kategori }}"
                                    class="absolute inset-0 h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            @else
                                <div
                                    class="absolute inset-0 bg-linear-to-br from-comfy-50 to-zinc-200 flex items-center justify-center">
                                    <span class="text-8xl text-comfy-800/10 font-serif font-bold select-none">
                                        {{ substr($kategori->kategori, 0, 1) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('landing.produk', ['kategori' => $kategori->id]) }}"
                            class="flex flex-1 flex-col justify-between p-6">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-zinc-900 group-hover:text-comfy-800 transition-colors">
                                    {{ $kategori->kategori }}
                                </h3>
                                <p class="mt-3 text-base text-zinc-500 line-clamp-2 leading-relaxed">
                                    {{ $kategori->deskripsi }}
                                </p>
                            </div>
                            <div class="mt-6 flex items-center gap-2 text-sm font-medium text-comfy-800">
                                <span>Explore Collection</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor"
                                    class="size-4 transform transition-transform group-hover:translate-x-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Latest Products -->
    <section id="products" class="py-24 bg-zinc-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center mb-16">
                <h2 class="text-3xl font-serif font-bold tracking-tight text-comfy-800 sm:text-4xl">5 Produk Unggulan
                </h2>
                <p class="mt-4 text-lg leading-8 text-zinc-600">Produk favorit yang paling banyak diminati oleh pelanggan
                    setia kami.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-5 xl:gap-x-8">
                @foreach ($produks as $produk)
                    <div class="group relative">
                        <div
                            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-zinc-200 lg:aspect-none group-hover:opacity-75 lg:h-80 relative">
                            @if ($produk->gambar)
                                <img src="{{ Str::startsWith($produk->gambar, ['http://', 'https://']) ? $produk->gambar : asset('storage/' . $produk->gambar) }}"
                                    alt="{{ $produk->nama }}"
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
                                    <a href="{{ route('landing.detail', $produk->id) }}">
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
                <a href="{{ route('landing.produk') }}"
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
@endsection
