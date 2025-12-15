<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'ComfyApparel - Comfort Meets Style')</title>

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

<body class="font-sans antialiased text-zinc-900 @yield('body-class', 'bg-white') flex flex-col min-h-screen" x-data="{ scrolled: false, mobileMenuOpen: false }"
    x-init="scrolled = (window.pageYOffset > 20)" @scroll.window="scrolled = (window.pageYOffset > 20)">

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
                    <span class="font-bold text-xl tracking-tight transition-colors"
                        :class="scrolled ? 'text-comfy-800' : 'text-comfy-800 @yield('nav-text-class-lg')'">
                        ComfyApparel
                    </span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ url('/#home') }}" class="text-sm font-medium transition-colors hover:text-comfy-500"
                        :class="scrolled ? 'text-zinc-600' : 'text-zinc-800 @yield('nav-text-class-lg') @yield('nav-hover-class-lg')'">Home</a>
                    <a href="{{ url('/#categories') }}"
                        class="text-sm font-medium transition-colors hover:text-comfy-500"
                        :class="scrolled ? 'text-zinc-600' : 'text-zinc-800 @yield('nav-text-class-lg') @yield('nav-hover-class-lg')'">Categories</a>
                    <a href="{{ route('landing.produk') }}"
                        class="text-sm font-medium transition-colors hover:text-comfy-500"
                        :class="scrolled ? 'text-zinc-600' : 'text-zinc-800 @yield('nav-text-class-lg') @yield('nav-hover-class-lg')'">Products</a>
                    <a href="{{ url('/#about') }}" class="text-sm font-medium transition-colors hover:text-comfy-500"
                        :class="scrolled ? 'text-zinc-600' : 'text-zinc-800 @yield('nav-text-class-lg') @yield('nav-hover-class-lg')'">About
                        Us</a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <!-- Balance Display -->
                        <div
                            class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-zinc-100/50 border border-zinc-200/50 backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4 text-comfy-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V4.505c0-.986.993-1.638 1.902-1.383 2.181.61 5.397 2.457 7.078 6.942.338.904-.37 1.848-1.282 2.172l-1.07.382z" />
                            </svg>
                            <span class="text-sm font-medium text-zinc-900">Rp
                                {{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }}</span>
                            <a href="{{ route('topup.index') }}"
                                class="ml-1 text-xs font-semibold text-comfy-600 hover:text-comfy-800 bg-comfy-100 hover:bg-comfy-200 px-2 py-0.5 rounded-full transition-colors">+</a>
                        </div>

                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.outside="open = false"
                                class="flex items-center gap-2 focus:outline-none group">
                                <span class="text-sm font-semibold transition-colors"
                                    :class="scrolled ? 'text-comfy-800' : 'text-comfy-800 @yield('nav-text-class-lg')'">
                                    {{ Auth::user()->name }}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="size-4 transition-transform duration-200"
                                    :class="[open ? 'rotate-180' : '', scrolled ? 'text-zinc-600' :
                                        'text-zinc-600 @yield('nav-icon-class-lg')'
                                    ]">
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
                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('dashboard') }}"
                                        class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 hover:rounded-full transition-colors">
                                        Dashboard
                                    </a>
                                @endif
                                <a href="{{ route('landing.profil') }}"
                                    class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 hover:rounded-full transition-colors">
                                    Profil
                                </a>
                                <a href="{{ route('landing.keranjang') }}"
                                    class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 hover:rounded-full transition-colors">
                                    Keranjang
                                </a>
                                <div class="border-t border-zinc-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:rounded-full transition-colors">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold transition-colors"
                            :class="scrolled ? 'text-comfy-800 hover:text-comfy-600' :
                                'text-comfy-800 @yield('nav-text-class-lg') @yield('nav-hover-class-lg')'">
                            Log in
                        </a>
                        <a href="{{ route('register') }}"
                            class="rounded-full px-5 py-2.5 text-sm font-semibold shadow-sm transition-all hover:scale-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2"
                            :class="scrolled ? 'bg-comfy-800 text-white hover:bg-comfy-800/90' :
                                'bg-white text-comfy-800 hover:bg-zinc-100'">
                            Sign Up
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center gap-4">
                    @auth
                        <!-- Mobile Balance Display (Simple) -->
                        <div class="flex items-center gap-1 px-2 py-1 rounded-md bg-zinc-100/50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4 text-comfy-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V4.505c0-.986.993-1.638 1.902-1.383 2.181.61 5.397 2.457 7.078 6.942.338.904-.37 1.848-1.282 2.172l-1.07.382z" />
                            </svg>
                            <span class="text-xs font-semibold text-zinc-900">Rp
                                {{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }}</span>
                        </div>

                        <!-- Mobile Cart Icon -->
                        <a href="{{ route('landing.keranjang') }}" class="text-zinc-600 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 5c.07.286.074.58.012.868-.568 2.508-2.618 4.625-5.336 4.625H8.452c-2.718 0-4.768-2.117-5.336-4.625-.062-.288-.058-.582.012-.868l1.263-5c.11-.439.42-.777.839-.908 1.956-.61 4.124-.61 6.08 0 .419.13.73.469.839.908z" />
                            </svg>
                        </a>
                    @endauth

                    <button type="button" class="text-zinc-600" @click="mobileMenuOpen = true">
                        <span class="sr-only">Open menu</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div x-show="mobileMenuOpen" class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
            <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/30 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>

            <div class="fixed inset-0 z-50 flex justify-end">
                <div x-show="mobileMenuOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-300 transform"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                    class="relative flex w-full max-w-xs flex-col bg-white pb-12 shadow-xl h-full">
                    <div class="flex px-4 pb-2 pt-5">
                        <button type="button"
                            class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-zinc-700"
                            @click="mobileMenuOpen = false">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Mobile Menu Links -->
                    <div class="mt-6 space-y-2 px-4">
                        <a href="{{ url('/#home') }}"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-zinc-900 hover:bg-zinc-50">Home</a>
                        <a href="{{ url('/#categories') }}"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-zinc-900 hover:bg-zinc-50">Categories</a>
                        <a href="{{ route('landing.produk') }}"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-zinc-900 hover:bg-zinc-50">Products</a>
                        <a href="{{ url('/#about') }}"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-zinc-900 hover:bg-zinc-50">About
                            Us</a>
                    </div>

                    <div class="border-t border-zinc-200 mt-6 pt-6 px-4">
                        @auth
                            <div class="flex items-center gap-x-4 mb-4">
                                <div
                                    class="h-10 w-10 flex-none rounded-full bg-comfy-100 flex items-center justify-center text-comfy-800 font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span
                                    class="text-base font-semibold leading-7 text-zinc-900">{{ Auth::user()->name }}</span>
                            </div>
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('dashboard') }}"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-zinc-900 hover:bg-zinc-50">Dashboard</a>
                            @endif
                            <a href="{{ route('landing.profil') }}"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-zinc-900 hover:bg-zinc-50">Profil</a>
                            <a href="{{ route('landing.keranjang') }}"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-zinc-900 hover:bg-zinc-50">Keranjang</a>
                            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                @csrf
                                <button type="submit"
                                    class="-mx-3 block w-full text-left rounded-lg px-3 py-2 text-base font-semibold leading-7 text-red-600 hover:bg-red-50">Log
                                    out</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-zinc-900 hover:bg-zinc-50">Log
                                in</a>
                            <a href="{{ route('register') }}"
                                class="mt-2 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-zinc-900 hover:bg-zinc-50">Sign
                                up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @section('main-wrapper')
        <main class="flex-grow pt-32 pb-16">
            @yield('content')
        </main>
    @show

    <!-- Footer -->
    <footer class="bg-comfy-800 text-white @yield('footer-class', 'mt-auto')" aria-labelledby="footer-heading">
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
