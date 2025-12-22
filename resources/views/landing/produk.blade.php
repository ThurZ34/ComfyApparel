@extends('layouts.landing')

@section('title', 'Our Collection - ComfyApparel')
@section('body-class', 'bg-zinc-50')

@section('main-wrapper')

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

            <!-- Filters & Sort -->
            <form action="{{ route('landing.produk') }}" method="GET" id="filterForm">
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 pb-6 border-b border-zinc-200 gap-6">

                    <!-- Category Pills -->
                    <div class="flex items-center gap-2 overflow-x-auto w-full sm:w-auto pb-2 sm:pb-0">
                        <a href="{{ route('landing.produk', request()->except('kategori')) }}"
                            class="px-4 py-2 rounded-full {{ !request('kategori') ? 'bg-comfy-800 text-white' : 'bg-white border border-zinc-200 text-zinc-600 hover:border-comfy-800 hover:text-comfy-800' }} text-sm font-medium whitespace-nowrap transition-colors">
                            All Items
                        </a>
                        @foreach ($kategoris as $cat)
                            <a href="{{ route('landing.produk', array_merge(request()->except('kategori'), ['kategori' => $cat->id])) }}"
                                class="px-4 py-2 rounded-full {{ request('kategori') == $cat->id ? 'bg-comfy-800 text-white' : 'bg-white border border-zinc-200 text-zinc-600 hover:border-comfy-800 hover:text-comfy-800' }} text-sm font-medium whitespace-nowrap transition-colors">
                                {{ $cat->kategori }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Sort & Filter Toggle -->
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-zinc-500">Sort:</span>
                            <select name="sort" onchange="this.form.submit()"
                                class="text-sm border-zinc-200 rounded-lg focus:ring-comfy-800 focus:border-comfy-800 text-zinc-700 py-2">
                                <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Terbaru
                                </option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Termurah
                                </option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Termahal
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Advanced Filters (Compact) -->
                <div class="bg-white rounded-2xl border border-zinc-200 p-6 mb-8" x-data="{ showFilters: {{ request()->hasAny(['search', 'harga_min', 'harga_max', 'stok']) ? 'true' : 'false' }} }">
                    <div class="flex items-center justify-between">
                        <button type="button" @click="showFilters = !showFilters"
                            class="flex items-center gap-2 text-sm font-medium text-zinc-700 hover:text-comfy-800 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                            </svg>
                            <span>Filter Lanjutan</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-4 transition-transform"
                                :class="showFilters ? 'rotate-180' : ''">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        @php
                            $activeFilters = collect([
                                request('search'),
                                request('harga_min'),
                                request('harga_max'),
                                request('stok'),
                            ])
                                ->filter()
                                ->count();
                        @endphp
                        @if ($activeFilters > 0)
                            <span
                                class="text-xs bg-comfy-100 text-comfy-800 px-2 py-1 rounded-full font-medium">{{ $activeFilters }}
                                filter aktif</span>
                        @endif
                    </div>

                    <div x-show="showFilters" x-collapse class="mt-4 pt-4 border-t border-zinc-100">
                        <!-- Preserve existing filters -->
                        @if (request('kategori'))
                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        @endif

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Search -->
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-2">Cari Produk</label>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Ketik nama produk..."
                                    class="w-full rounded-xl border-zinc-200 text-sm py-3 px-4 focus:ring-comfy-800 focus:border-comfy-800">
                            </div>

                            <!-- Harga Min -->
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-2">Harga Minimum (Rp)</label>
                                <input type="number" name="harga_min" value="{{ request('harga_min') }}"
                                    placeholder="Contoh: 50000" min="0"
                                    class="w-full rounded-xl border-zinc-200 text-sm py-3 px-4 focus:ring-comfy-800 focus:border-comfy-800">
                            </div>

                            <!-- Harga Max -->
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-2">Harga Maksimum (Rp)</label>
                                <input type="number" name="harga_max" value="{{ request('harga_max') }}"
                                    placeholder="Contoh: 500000" min="0"
                                    class="w-full rounded-xl border-zinc-200 text-sm py-3 px-4 focus:ring-comfy-800 focus:border-comfy-800">
                            </div>

                            <!-- Stok -->
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 mb-2">Ketersediaan Stok</label>
                                <select name="stok"
                                    class="w-full rounded-xl border-zinc-200 text-sm py-3 px-4 focus:ring-comfy-800 focus:border-comfy-800">
                                    <option value="">Semua</option>
                                    <option value="in_stock" {{ request('stok') == 'in_stock' ? 'selected' : '' }}>Tersedia
                                    </option>
                                    <option value="out_of_stock" {{ request('stok') == 'out_of_stock' ? 'selected' : '' }}>
                                        Habis</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 mt-4">
                            <button type="submit"
                                class="px-4 py-2 bg-comfy-800 text-white text-sm font-medium rounded-lg hover:bg-comfy-900 transition-colors">
                                Terapkan
                            </button>
                            <a href="{{ route('landing.produk') }}"
                                class="px-4 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-900 transition-colors">
                                Reset Semua
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Results Count -->
            <div class="flex items-center justify-between mb-6">
                <p class="text-sm text-zinc-600">
                    Menampilkan <span class="font-semibold text-zinc-900">{{ $produks->total() }}</span> produk
                    @if (request('search'))
                        untuk "<span class="text-comfy-800">{{ request('search') }}</span>"
                    @endif
                </p>
            </div>

            <!-- Products Grid -->
            @if ($produks->count() > 0)
                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach ($produks as $produk)
                        <div
                            class="group relative bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col overflow-hidden border border-zinc-100">
                            <!-- Image -->
                            <div class="aspect-4/5 w-full overflow-hidden bg-zinc-200 relative">
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
                                @if ($produk->stok == 0)
                                    <div
                                        class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                        Out of Stock
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
                                    <form action="{{ route('cart.add', $produk->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-white text-comfy-800 px-6 py-2 rounded-full shadow-lg font-medium text-sm hover:bg-comfy-50 transition-colors flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                            </svg>
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex-1 flex flex-col">
                                <p class="text-xs text-zinc-500 mb-1">
                                    {{ $produk->kategori->kategori ?? 'Collection' }}</p>
                                <h3
                                    class="text-base font-bold text-zinc-900 mb-1 group-hover:text-comfy-800 transition-colors">
                                    <a href="{{ route('landing.detail', $produk->id) }}">
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
                    <h3 class="mt-2 text-sm font-medium text-zinc-900">Tidak ada produk ditemukan</h3>
                    <p class="mt-1 text-sm text-zinc-500">Coba ubah filter atau reset untuk melihat semua produk.</p>
                    <a href="{{ route('landing.produk') }}"
                        class="mt-4 inline-block text-sm font-medium text-comfy-800 hover:text-comfy-600">
                        Reset Filter →
                    </a>
                </div>
            @endif

        </div>
    </main>
@endsection
