<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Profile - ComfyApparel</title>

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
                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('dashboard') }}"
                                        class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 transition-colors">
                                        Dashboard
                                    </a>
                                @endif
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
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-zinc-100">
                <!-- Cover Image -->
                <div class="h-48 w-full bg-gradient-to-r from-comfy-800 to-comfy-600 relative">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>

                <div class="relative px-6 pb-6">
                    <!-- Profile Header (Avatar overlap) -->
                    <div
                        class="relative -mt-16 sm:-mt-20 flex flex-col sm:flex-row items-center sm:items-end gap-6 mb-8">
                        <div class="relative group">
                            <div
                                class="h-32 w-32 sm:h-40 sm:w-40 rounded-full border-4 border-white bg-zinc-200 overflow-hidden shadow-md flex items-center justify-center text-4xl font-bold text-zinc-400 select-none">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <!-- Edit Avatar Button (Visual only for now) -->
                            <button
                                class="absolute bottom-1 right-1 bg-white p-2 rounded-full shadow-md text-zinc-600 hover:text-comfy-800 transition-colors border border-zinc-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                </svg>
                            </button>
                        </div>
                        <div class="text-center sm:text-left flex-1 mb-2">
                            <h1 class="text-3xl font-bold text-zinc-900 font-serif">{{ Auth::user()->name }}</h1>
                            <p class="text-zinc-500 font-medium">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="mb-4 sm:mb-2">
                            <span
                                class="px-4 py-1.5 rounded-full text-sm font-semibold bg-comfy-50 text-comfy-800 border border-comfy-100 shadow-sm capitalize">
                                {{ Auth::user()->role ?? 'Customer' }}
                            </span>
                        </div>
                    </div>

                    <!-- Tabs/Navigation -->
                    <div class="border-b border-zinc-200 mb-8" x-data="{ tab: 'profile' }">
                        <nav class="-mb-px flex space-x-8 justify-center sm:justify-start" aria-label="Tabs">
                            <button @click="tab = 'profile'"
                                :class="tab === 'profile' ? 'border-comfy-800 text-comfy-800' :
                                    'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300'"
                                class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                Profile Settings
                            </button>
                            {{-- <button @click="tab = 'orders'"
                                :class="tab === 'orders' ? 'border-comfy-800 text-comfy-800' :
                                    'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300'"
                                class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                Order History
                            </button> --}}
                        </nav>
                    </div>

                    <!-- Profile Content -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                        <!-- Left Column: Personal Info Form -->
                        <div class="lg:col-span-2 space-y-8">
                            <!-- Basic Information -->
                            <section>
                                <h2 class="text-lg font-semibold text-zinc-900 mb-4 flex items-center gap-2">
                                    Basic Information
                                </h2>
                                <div class="bg-zinc-50 rounded-xl p-6 border border-zinc-100">
                                    <form action="{{ route('user-profile-information.update') }}" method="POST"
                                        class="space-y-4">
                                        @csrf
                                        @method('PUT')

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label for="name"
                                                    class="block text-sm font-medium text-zinc-700 mb-1">Full
                                                    Name</label>
                                                <input type="text" name="name" id="name"
                                                    value="{{ Auth::user()->name }}"
                                                    class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-sm py-3 px-4">
                                                @error('name')
                                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="email"
                                                    class="block text-sm font-medium text-zinc-700 mb-1">Email
                                                    Address</label>
                                                <input type="email" name="email" id="email"
                                                    value="{{ Auth::user()->email }}"
                                                    class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-sm py-3 px-4">
                                                @error('email')
                                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex justify-end pt-2">
                                            <button type="submit"
                                                class="px-6 py-2.5 bg-comfy-800 text-white text-sm font-medium rounded-lg hover:bg-comfy-900 transition-colors shadow-sm shadow-comfy-800/20">
                                                Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </section>

                            <!-- Password Update -->
                            <section>
                                <h2 class="text-lg font-semibold text-zinc-900 mb-4 flex items-center gap-2">
                                    Security
                                </h2>
                                <div class="bg-zinc-50 rounded-xl p-6 border border-zinc-100">
                                    <form action="{{ route('user-password.update') }}" method="POST"
                                        class="space-y-4">
                                        @csrf
                                        @method('PUT')

                                        <div>
                                            <label for="current_password"
                                                class="block text-sm font-medium text-zinc-700 mb-1">Current
                                                Password</label>
                                            <input type="password" name="current_password" id="current_password"
                                                class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-sm py-3 px-4">
                                            @error('current_password', 'updatePassword')
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label for="password"
                                                    class="block text-sm font-medium text-zinc-700 mb-1">New
                                                    Password</label>
                                                <input type="password" name="password" id="password"
                                                    class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-sm py-3 px-4">
                                                @error('password', 'updatePassword')
                                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="password_confirmation"
                                                    class="block text-sm font-medium text-zinc-700 mb-1">Confirm
                                                    New Password</label>
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation"
                                                    class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-sm py-3 px-4">
                                            </div>
                                        </div>

                                        <div class="flex justify-end pt-2">
                                            <button type="submit"
                                                class="px-6 py-2.5 bg-white border border-zinc-300 text-zinc-700 text-sm font-medium rounded-lg hover:bg-zinc-50 transition-colors shadow-sm">
                                                Update Password
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>

                        <!-- Right Column: Stats / Deletion -->
                        <div class="space-y-8">
                            <!-- Account Summary -->
                            <section>
                                <h2 class="text-lg font-semibold text-zinc-900 mb-4">Account Summary</h2>
                                <div class="bg-zinc-50 rounded-xl p-6 border border-zinc-100 flex flex-col gap-4">
                                    <div class="flex items-center justify-between py-2 border-b border-zinc-200/50">
                                        <span class="text-sm text-zinc-600">Member Since</span>
                                        <span class="text-sm font-medium text-zinc-900">
                                            {{ Auth::user()->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between py-2 border-b border-zinc-200/50">
                                        <span class="text-sm text-zinc-600">Total Orders</span>
                                        <span class="text-sm font-medium text-zinc-900">0</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2">
                                        <span class="text-sm text-zinc-600">Wishlist Items</span>
                                        <span class="text-sm font-medium text-zinc-900">0</span>
                                    </div>
                                </div>
                            </section>

                            <!-- Delete Account -->
                            {{-- <section>
                                <h2 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h2>
                                <div class="bg-red-50 rounded-xl p-6 border border-red-100 text-center">
                                    <p class="text-xs text-red-600/80 mb-4 leading-relaxed">
                                        Once you delete your account, there is no going back. Please be certain.
                                    </p>
                                    <button class="w-full px-4 py-2 bg-white border border-red-200 text-red-600 text-sm font-medium rounded-lg hover:bg-red-50 hover:border-red-300 transition-colors shadow-sm">
                                        Delete Account
                                    </button>
                                </div>
                            </section> --}}
                        </div>
                    </div>
                </div>
            </div>
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
