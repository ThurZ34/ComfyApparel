<header
    class="sticky top-0 z-40 flex h-20 w-full items-center justify-between border-b border-zinc-200 bg-white/80 px-6 backdrop-blur-md transition-all">

    <!-- Left: Collapse Button & Breadcrumb -->
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = !sidebarOpen"
            class="p-2 -ml-2 rounded-lg text-zinc-500 hover:bg-zinc-100 hover:text-black transition-colors focus:outline-none focus:ring-2 focus:ring-zinc-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <!-- Optional Breadcrumb -->
        <nav class="hidden md:flex items-center text-sm font-medium text-zinc-500">
            <a href="{{ route('dashboard') }}" class="hover:text-black transition-colors">Admin</a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="size-3 mx-2 text-zinc-300">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
            <span class="text-black bg-zinc-100 px-2 py-0.5 rounded-md">Dashboard</span>
        </nav>
    </div>

    <!-- Right: Actions -->
    <div class="flex items-center gap-4">

        <!-- Notifications -->
        <button
            class="relative p-2 rounded-full text-zinc-500 hover:bg-zinc-100 hover:text-black transition-colors group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <span class="absolute top-2 right-2 size-2 bg-red-500 rounded-full border-2 border-white"></span>
        </button>

        <div class="h-8 w-px bg-zinc-200 mx-1"></div>

        <!-- Profile Dropdown (Simplified) -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.outside="open = false"
                class="flex items-center gap-2 focus:outline-none group">
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=000&color=fff" alt="Avatar"
                    class="h-9 w-9 rounded-full ring-2 ring-transparent group-hover:ring-zinc-200 transition-all">
                <div class="hidden md:block text-left">
                    <p class="text-sm font-semibold text-zinc-900 group-hover:text-black">Fathur Rahman</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4 text-zinc-500 transition-transform duration-200"
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
                <div class="px-4 py-2 border-b border-zinc-100">
                    <p class="text-sm text-zinc-900 font-semibold">Fathur Rahman</p>
                    <p class="text-xs text-zinc-500 truncate">fathur@example.com</p>
                </div>
                <a href="#" class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 transition-colors">My
                    Profile</a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 transition-colors">Settings</a>
                <div class="border-t border-zinc-100 my-1"></div>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                        Log Out
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>
