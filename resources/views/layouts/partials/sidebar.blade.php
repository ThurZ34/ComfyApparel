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
            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200 group text-zinc-500 hover:bg-comfy-50 hover:text-comfy-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                <span class="whitespace-nowrap" x-show="sidebarOpen">Users</span>
            </a>

            <!-- Settings Link -->
            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200 group text-zinc-500 hover:bg-comfy-50 hover:text-comfy-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.212 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="whitespace-nowrap" x-show="sidebarOpen">Settings</span>
            </a>

        </nav>

        <!-- User Section -->
        <div class="p-4 border-t border-zinc-200">
            <button class="flex items-center gap-3 w-full p-2 rounded-lg hover:bg-comfy-50 transition-colors group">
                <div
                    class="h-8 w-8 rounded-full bg-comfy-200 text-comfy-800 border border-comfy-500 flex items-center justify-center font-bold text-sm shrink-0">
                    A
                </div>
                <div class="flex-1 text-left overflow-hidden" x-show="sidebarOpen">
                    <p class="text-sm font-semibold text-zinc-900 group-hover:text-comfy-800 truncate">Admin User</p>
                    <p class="text-xs text-zinc-500 truncate">admin@example.com</p>
                </div>
                <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-4 text-zinc-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                </svg>
            </button>
        </div>
    </aside>
