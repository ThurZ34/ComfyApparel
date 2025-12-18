    <aside
        class="fixed inset-y-0 left-0 z-50 w-72 bg-white text-black transition-all duration-300 ease-in-out border-r border-zinc-200 flex flex-col">

        <!-- Logo Section -->
        <div class="h-20 flex items-center justify-center border-b border-zinc-200 px-6">
            <a href="/" class="flex items-center gap-3 group">
                <div
                    class="bg-comfy-800 text-white p-2 rounded-lg group-hover:scale-105 transition-transform shadow-md shadow-comfy-800/20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                    </svg>
                </div>
                <span class="font-bold text-xl text-comfy-800">
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
                <span class="whitespace-nowrap">Dashboard</span>
            </a>

            <!-- Section Divider -->
            <div class="pt-4 pb-2">
                <p class="text-xs font-bold text-zinc-600 uppercase tracking-widest px-3">Management</p>
            </div>

            <!-- Pengguna Link -->
            <a href="{{ route('produk.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200 group
           {{ request()->routeIs('produk.index') ? 'bg-comfy-800 text-white font-semibold shadow-md shadow-comfy-800/20' : 'text-zinc-500 hover:bg-comfy-50 hover:text-comfy-800' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                </svg> <span class="whitespace-nowrap">Produk</span>
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
                <span class="whitespace-nowrap">Kategori</span>
            </a>

            <a href="{{ route('pengguna.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200 group
           {{ request()->routeIs('pengguna.index') ? 'bg-comfy-800 text-white font-semibold shadow-md shadow-comfy-800/20' : 'text-zinc-500 hover:bg-comfy-50 hover:text-comfy-800' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span class="whitespace-nowrap">Pengguna</span>
            </a>

            <a href="{{ route('transaksi_log.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200 group
           {{ request()->routeIs('transaksi_log.*') ? 'bg-comfy-800 text-white font-semibold shadow-md shadow-comfy-800/20' : 'text-zinc-500 hover:bg-comfy-50 hover:text-comfy-800' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <span class="whitespace-nowrap">Transaksi</span>
            </a>

            <a href="{{ route('topup-admin.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200 group
           {{ request()->routeIs('topup-admin.index') ? 'bg-comfy-800 text-white font-semibold shadow-md shadow-comfy-800/20' : 'text-zinc-500 hover:bg-comfy-50 hover:text-comfy-800' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>

                <span class="whitespace-nowrap">Topup</span>
            </a>

        </nav>

        <!-- Footer / Back Button -->
        <div class="border-t border-zinc-200 p-3 bg-zinc-50/50">
            <a href="{{ route('landing.home') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-zinc-600 hover:bg-red-50 hover:text-red-600 transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 group-hover:-translate-x-1 transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                <span class="whitespace-nowrap font-medium">Kembali</span>
            </a>
        </div>

    </aside>
