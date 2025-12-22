<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased h-full bg-zinc-50 text-zinc-900 selection:bg-black selection:text-white"
    x-data="{ sidebarOpen: false }">

    <!-- Mobile Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-zinc-900/80 z-40 lg:hidden" x-cloak></div>

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 transition-all duration-300 ease-in-out lg:pl-72">

            <!-- Header -->
            @include('layouts.partials.header')

            <!-- Main Content -->
            <main class="flex-1 py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
                <!-- Page Title -->
                @if (isset($header))
                    <header class="mb-8 fade-in">
                        <h1 class="text-3xl font-bold tracking-tight text-zinc-900">
                            {{ $header }}
                        </h1>
                    </header>
                @elseif (View::hasSection('header'))
                    <header class="mb-8 fade-in">
                        <h1 class="text-3xl font-bold tracking-tight text-zinc-900">
                            @yield('header')
                        </h1>
                    </header>
                @endif

                <!-- Content Slot -->
                <div class="fade-in-up">
                    @if (isset($slot) && !$slot->isEmpty())
                        {{ $slot }}
                    @else
                        @yield('content')
                    @endif
                </div>
            </main>

            <!-- Simple Footer -->
            <footer class="py-6 text-center text-sm text-zinc-500 border-t border-zinc-200 bg-white">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </footer>
        </div>
    </div>

</body>

</html>
