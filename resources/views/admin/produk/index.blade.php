@extends('layouts.app')

@section('header')
    Manajemen Produk
@endsection

@section('content')
    <div x-data="{
        createModalOpen: false,
        editModalOpen: false,
        deleteModalOpen: false,
        currentProduct: {
            id: null,
            nama: '',
            harga: '',
            stok: '',
            deskripsi: '',
            gambar_url: ''
        },
        deleteUrl: '',
        resetForm() {
            this.currentProduct = {
                id: null,
                nama: '',
                harga: '',
                stok: '',
                deskripsi: '',
                gambar_url: ''
            };
        },
        editProduct(product) {
            this.currentProduct = {
                id: product.id,
                nama: product.nama,
                harga: product.harga,
                stok: product.stok,
                deskripsi: product.deskripsi || '',
                gambar_url: product.gambar_url
            };
            this.editModalOpen = true;
        },
        confirmDelete(url) {
            this.deleteUrl = url;
            this.deleteModalOpen = true;
        }
    }">

        <div class="space-y-6">
            <!-- Action Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="w-full sm:max-w-xs relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <form action="{{ route('produk.index') }}" method="GET">
                        <input type="text" name="search"
                            class="block w-full pl-10 pr-3 py-2 border border-zinc-200 rounded-lg leading-5 bg-white placeholder-zinc-400 focus:outline-none focus:placeholder-zinc-300 focus:border-comfy-800 focus:ring-comfy-800 sm:text-sm transition duration-150 ease-in-out"
                            placeholder="Cari produk...">
                    </form>
                </div>

                <div class="flex items-center gap-3">
                    <!-- Trigger Create Modal -->
                    <button @click="createModalOpen = true; resetForm()" type="button"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-comfy-800 hover:bg-comfy-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-comfy-800 transition-all">
                        <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Produk
                    </button>
                </div>
            </div>

            <!-- Content (Grid Layout) -->
            <div>
                @if ($produk->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($produk as $item)
                            <div
                                class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden hover:shadow-md transition-shadow duration-300 flex flex-col group">
                                <!-- Image Section -->
                                <div class="relative aspect-[4/3] bg-zinc-100 overflow-hidden">
                                    @if ($item->gambar)
                                        <img class="h-full w-full object-cover transform group-hover:scale-105 transition-transform duration-500 will-change-transform"
                                            src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama }}">
                                    @else
                                        <div class="flex items-center justify-center h-full">
                                            <svg class="h-12 w-12 text-zinc-300" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif

                                    <!-- Status Badge -->
                                    <div class="absolute top-3 right-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold shadow-sm {{ $item->stok > 10 ? 'bg-emerald-100 text-emerald-800' : ($item->stok > 0 ? 'bg-amber-100 text-amber-800' : 'bg-red-100 text-red-800') }}">
                                            @if ($item->stok > 10)
                                                Tersedia
                                            @elseif($item->stok > 0)
                                                Hampir Habis
                                            @else
                                                Habis
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <!-- Content Section -->
                                <div class="p-5 flex-1 flex flex-col">
                                    <h3 class="text-lg font-bold text-zinc-900 line-clamp-1 mb-1"
                                        title="{{ $item->nama }}">
                                        {{ $item->nama }}
                                    </h3>
                                    <p class="text-sm text-zinc-500 line-clamp-2 min-h-[40px] mb-4">
                                        {{ $item->deskripsi ?? 'Tidak ada deskripsi' }}
                                    </p>

                                    <div class="mt-auto space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-lg font-bold text-comfy-800">
                                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                                            </span>
                                            <span
                                                class="text-xs font-medium text-zinc-500 bg-zinc-100 px-2 py-1 rounded-md">
                                                Stok: {{ $item->stok }}
                                            </span>
                                        </div>

                                        <!-- Actions -->
                                        <div class="grid grid-cols-2 gap-3 pt-3 border-t border-zinc-100">
                                            <button
                                                @click="editProduct({
                                                    id: '{{ $item->id }}',
                                                    nama: '{{ addslashes($item->nama) }}',
                                                    harga: '{{ $item->harga }}',
                                                    stok: '{{ $item->stok }}',
                                                    deskripsi: '{{ addslashes($item->deskripsi) }}',
                                                    gambar_url: '{{ $item->gambar ? Storage::url($item->gambar) : '' }}'
                                                })"
                                                class="flex items-center justify-center gap-2 px-3 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-200 rounded-lg hover:bg-zinc-50 hover:text-indigo-600 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </button>
                                            <button
                                                @click="confirmDelete('{{ route('produk.destroy', $item->id) }}')"
                                                class="flex items-center justify-center gap-2 px-3 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-200 rounded-lg hover:bg-zinc-50 hover:text-red-600 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden text-center py-16">
                        <svg class="mx-auto h-12 w-12 text-zinc-300" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-zinc-900">Belum ada produk</h3>
                        <p class="mt-1 text-sm text-zinc-500">Mulai dengan menambahkan produk baru ke inventaris Anda.</p>
                        <div class="mt-6">
                            <button @click="createModalOpen = true"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-comfy-800 hover:bg-comfy-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-comfy-800">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Produk Baru
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Create Modal -->
        <div x-show="createModalOpen" class="relative z-50 pointer-events-none" aria-labelledby="modal-title"
            role="dialog" aria-modal="true" x-cloak>
            <div x-show="createModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-zinc-500 bg-opacity-75 transition-opacity pointer-events-auto"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto pointer-events-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div x-show="createModalOpen" @click.away="createModalOpen = false"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                        <!-- Header -->
                        <div class="bg-comfy-800 px-4 py-3 sm:px-6 flex justify-between items-center">
                            <h3 class="text-base font-semibold leading-6 text-white" id="modal-title">Tambah Produk Baru
                            </h3>
                            <button @click="createModalOpen = false" class="text-comfy-200 hover:text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="px-4 py-5 sm:p-6 space-y-4">
                                <!-- Nama Produk -->
                                <div>
                                    <label for="nama" class="block text-sm font-medium leading-6 text-zinc-900">Nama
                                        Produk</label>
                                    <div class="mt-2">
                                        <input type="text" name="nama" id="nama" required
                                            class="p-4 block w-full rounded-md border-0 py-1.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <!-- Harga & Stok -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="harga"
                                            class="p-4 block text-sm font-medium leading-6 text-zinc-900">Harga (Rp)</label>
                                        <div class="mt-2 relative rounded-md shadow-sm">
                                            <div
                                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <span class="text-zinc-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="number" name="harga" id="harga" required
                                                class="p-4 block w-full rounded-md border-0 py-1.5 pl-10 text-zinc-900 ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6"
                                                placeholder="0">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="stok"
                                            class="p-4 block text-sm font-medium leading-6 text-zinc-900">Stok</label>
                                        <div class="mt-2">
                                            <input type="number" name="stok" id="stok" required
                                                class="p-4 block w-full rounded-md border-0 py-1.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>
                                </div>

                                <!-- Deskripsi -->
                                <div>
                                    <label for="deskripsi"
                                        class="p-4 block text-sm font-medium leading-6 text-zinc-900">Deskripsi</label>
                                    <div class="mt-2">
                                        <textarea id="deskripsi" name="deskripsi" rows="3"
                                            class="p-4 block w-full rounded-md border-0 py-1.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                </div>

                                <!-- Gambar -->
                                <div>
                                    <label for="gambar" class="p-4 block text-sm font-medium leading-6 text-zinc-900">Gambar
                                        Produk</label>
                                    <div class="mt-2">
                                        <input type="file" name="gambar" id="gambar" accept="image/*" required
                                            class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-comfy-50 file:text-comfy-800 hover:file:bg-comfy-100">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-zinc-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="submit"
                                    class="inline-flex w-full justify-center rounded-md bg-comfy-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-comfy-900 sm:ml-3 sm:w-auto">Simpan</button>
                                <button type="button" @click="createModalOpen = false"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 sm:mt-0 sm:w-auto">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div x-show="editModalOpen" class="relative z-50 pointer-events-none" aria-labelledby="modal-title"
            role="dialog" aria-modal="true" x-cloak>
            <div x-show="editModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-zinc-500 bg-opacity-75 transition-opacity pointer-events-auto"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto pointer-events-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div x-show="editModalOpen" @click.away="editModalOpen = false"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                        <!-- Header -->
                        <div class="bg-comfy-800 px-4 py-3 sm:px-6 flex justify-between items-center">
                            <h3 class="text-base font-semibold leading-6 text-white" id="modal-title">Edit Produk</h3>
                            <button @click="editModalOpen = false" class="text-comfy-200 hover:text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form x-bind:action="'/admin/produk/' + currentProduct.id" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="px-4 py-5 sm:p-6 space-y-4">
                                <!-- Nama Produk -->
                                <div>
                                    <label for="edit_nama" class="block text-sm font-medium leading-6 text-zinc-900">Nama
                                        Produk</label>
                                    <div class="mt-2">
                                        <input type="text" name="nama" id="edit_nama"
                                            x-model="currentProduct.nama" required
                                            class="block w-full rounded-md border-0 py-1.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <!-- Harga & Stok -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="edit_harga"
                                            class="block text-sm font-medium leading-6 text-zinc-900">Harga (Rp)</label>
                                        <div class="mt-2 relative rounded-md shadow-sm">
                                            <div
                                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <span class="text-zinc-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="number" name="harga" id="edit_harga"
                                                x-model="currentProduct.harga" required
                                                class="block w-full rounded-md border-0 py-1.5 pl-10 text-zinc-900 ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="edit_stok"
                                            class="block text-sm font-medium leading-6 text-zinc-900">Stok</label>
                                        <div class="mt-2">
                                            <input type="number" name="stok" id="edit_stok"
                                                x-model="currentProduct.stok" required
                                                class="block w-full rounded-md border-0 py-1.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>
                                </div>

                                <!-- Deskripsi -->
                                <div>
                                    <label for="edit_deskripsi"
                                        class="block text-sm font-medium leading-6 text-zinc-900">Deskripsi</label>
                                    <div class="mt-2">
                                        <textarea id="edit_deskripsi" name="deskripsi" rows="3" x-model="currentProduct.deskripsi"
                                            class="block w-full rounded-md border-0 py-1.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                </div>

                                <!-- Gambar Review -->
                                <div class="flex items-center gap-4">
                                    <div x-show="currentProduct.gambar_url" class="shrink-0">
                                        <img :src="currentProduct.gambar_url" alt="Current Image"
                                            class="h-16 w-16 object-cover rounded-md border border-zinc-200">
                                    </div>
                                    <div class="grow">
                                        <label for="edit_gambar"
                                            class="block text-sm font-medium leading-6 text-zinc-900">Ganti Gambar
                                            (Opsional)</label>
                                        <div class="mt-2">
                                            <input type="file" name="gambar" id="edit_gambar" accept="image/*"
                                                class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-comfy-50 file:text-comfy-800 hover:file:bg-comfy-100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-zinc-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="submit"
                                    class="inline-flex w-full justify-center rounded-md bg-comfy-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-comfy-900 sm:ml-3 sm:w-auto">Simpan
                                    Perubahan</button>
                                <button type="button" @click="editModalOpen = false"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 sm:mt-0 sm:w-auto">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal Confirmation -->
        <div x-show="deleteModalOpen" class="relative z-50 pointer-events-none" aria-labelledby="modal-title"
            role="dialog" aria-modal="true" x-cloak>
            <div x-show="deleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-zinc-500 bg-opacity-75 transition-opacity pointer-events-auto"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto pointer-events-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div x-show="deleteModalOpen" @click.away="deleteModalOpen = false"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-base font-semibold leading-6 text-zinc-900" id="modal-title">Hapus
                                        Produk</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-zinc-500">Apakah Anda yakin ingin menghapus produk ini? Data
                                            yang dihapus tidak dapat dikembalikan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-zinc-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <form :action="deleteUrl" method="POST" class="inline-block w-full sm:w-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Hapus</button>
                            </form>
                            <button type="button" @click="deleteModalOpen = false"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 sm:mt-0 sm:w-auto">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
