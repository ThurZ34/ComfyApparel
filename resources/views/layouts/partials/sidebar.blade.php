    <!-- Mobile Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-zinc-900/80 z-40 lg:hidden backdrop-blur-sm" x-cloak>
    </div>

    <aside
        class="fixed inset-y-0 left-0 z-50 bg-white text-black transition-all duration-300 ease-in-out border-r border-zinc-200 flex flex-col"
        :class="sidebarOpen ? 'w-72 translate-x-0' : '-translate-x-full lg:translate-x-0 lg:w-20'" x-cloak>

        <!-- Logo Section -->
        <div class="h-20 flex items-center justify-center border-b border-zinc-200 transition-all duration-300"
            :class="sidebarOpen ? 'px-6' : 'px-0'">
            <a href="/" class="flex items-center gap-3 group">
                <div
                    class="bg-comfy-800 text-white p-2 rounded-lg group-hover:scale-105 transition-transform shadow-md shadow-comfy-800/20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                    </svg>
                </div>
                <span class="font-bold text-xl transition-opacity duration-300 text-comfy-800" x-show="sidebarOpen"
                    x-transition>
                    ComfyAdmin
                </span>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-2">

            <!-- Dashboard Link -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200 group
           {{ request()->routeIs('dashboard') ? 'bg-comfy-800 text-white font-semibold shadow-md shadow-comfy-800/20' : 'text-zinc-500 hover:bg-comfy-50 hover:text-comfy-800' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                <span class="whitespace-nowrap transition-all duration-300" x-show="sidebarOpen">Dashboard</span>

                <!-- Tooltip for collapsed state -->
                <div class="absolute left-full rounded-md px-2 py-1 ml-6 bg-zinc-900 text-white text-sm invisible opacity-0 -translate-x-3 transition-all group-hover:visible group-hover:opacity-100 group-hover:translate-x-0 lg:hidden"
                    :class="!sidebarOpen ? 'lg:block' : ''">
                    Dashboard
                </div>
            </a>

            <!-- Section Divider -->
            <div class="pt-4 pb-2" x-show="sidebarOpen">
                <p class="text-xs font-bold text-zinc-600 uppercase tracking-widest px-3">Management</p>
            </div>
            <div class="pt-4 border-t border-zinc-800 mb-2" x-show="!sidebarOpen"></div>

            <!-- Users Link -->
            <a href="{{ route('produk.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200 group
           {{ request()->routeIs('produk.index') ? 'bg-comfy-800 text-white font-semibold shadow-md shadow-comfy-800/20' : 'text-zinc-500 hover:bg-comfy-50 hover:text-comfy-800' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                </svg> <span class="whitespace-nowrap transition-all duration-300" x-show="sidebarOpen">Produk</span>

                <!-- Tooltip for collapsed state -->
                <div class="absolute left-full rounded-md px-2 py-1 ml-6 bg-zinc-900 text-white text-sm invisible opacity-0 -translate-x-3 transition-all group-hover:visible group-hover:opacity-100 group-hover:translate-x-0 lg:hidden"
                    :class="!sidebarOpen ? 'lg:block' : ''">
                    Produk
                </div>
            </a>

            <!-- Settings Link -->
            <a href="{{ route('kategori.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200 group
           {{ request()->routeIs('kategori.index') ? 'bg-comfy-800 text-white font-semibold shadow-md shadow-comfy-800/20' : 'text-zinc-500 hover:bg-comfy-50 hover:text-comfy-800' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>
                <span class="whitespace-nowrap transition-all duration-300" x-show="sidebarOpen">Kategori</span>

                <!-- Tooltip for collapsed state -->
                <div class="absolute left-full rounded-md px-2 py-1 ml-6 bg-zinc-900 text-white text-sm invisible opacity-0 -translate-x-3 transition-all group-hover:visible group-hover:opacity-100 group-hover:translate-x-0 lg:hidden"
                    :class="!sidebarOpen ? 'lg:block' : ''">
                    Kategori
                </div>
            </a>

        </nav>

    </aside>
