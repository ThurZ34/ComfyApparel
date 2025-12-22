@extends('layouts.app')

@section('header')
    Manajemen Kategori
@endsection

@section('content')
    <div x-data="{
        createModalOpen: {{ $errors->storeKategori->any() ? 'true' : 'false' }},
        editModalOpen: {{ $errors->updateKategori->any() ? 'true' : 'false' }},
        deleteModalOpen: false,
        currentKategori: {
            id: '{{ old('id') }}', // Only relevant if updateKategori fails
            kategori: '{{ old('kategori') && $errors->updateKategori->any() ? old('kategori') : '' }}',
            deskripsi: '{{ old('deskripsi') && $errors->updateKategori->any() ? old('deskripsi') : '' }}'
        },
        deleteUrl: '',
        resetForm() {
            this.currentKategori = {
                id: null,
                kategori: '',
                deskripsi: ''
            };
        },
        editKategori(item) {
            this.currentKategori = {
                id: item.id,
                kategori: item.kategori,
                deskripsi: item.deskripsi || ''
            };
            this.editModalOpen = true;
        },
        confirmDelete(url) {
            this.deleteUrl = url;
            this.deleteModalOpen = true;
        }
    }">

        <div class="space-y-6">
            <!-- Alerts -->
            @if (session('success'))
                <div class="rounded-md bg-green-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Action Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="w-full sm:max-w-xs relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text"
                        class="block w-full pl-10 pr-3 py-2 border border-zinc-200 rounded-lg leading-5 bg-white placeholder-zinc-400 focus:outline-none focus:placeholder-zinc-300 focus:border-comfy-800 focus:ring-comfy-800 sm:text-sm transition duration-150 ease-in-out"
                        placeholder="Cari kategori...">
                </div>

                <div class="flex items-center gap-3">
                    <button @click="createModalOpen = true; resetForm()" type="button"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-comfy-800 hover:bg-comfy-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-comfy-800 transition-all">
                        <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Kategori
                    </button>
                </div>
            </div>

            <!-- Table Content -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                @if ($kategori->count() > 0)
                    <!-- Modern Grid Cards Layout -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-zinc-200">
                            <thead class="bg-zinc-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                        Nama Kategori
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                        Total Produk
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                        Deskripsi
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-zinc-200">
                                @foreach ($kategori as $index => $item)
                                    <tr class="hover:bg-zinc-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                            {{ $kategori->firstItem() + $index }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-zinc-900">{{ $item->kategori }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center rounded-md bg-zinc-50 px-2 py-1 text-xs font-medium text-zinc-600 ring-1 ring-inset ring-zinc-500/10">
                                                {{ $item->produk_count }} Produk
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-zinc-500 line-clamp-2">{{ $item->deskripsi }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex justify-center gap-2">
                                                <button
                                                    @click="editKategori({
                                                    id: '{{ $item->id }}',
                                                    kategori: '{{ addslashes($item->kategori) }}',
                                                    deskripsi: '{{ addslashes($item->deskripsi) }}'
                                                })"
                                                    class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-lg transition-colors"
                                                    title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button
                                                    @click="confirmDelete('{{ route('kategori.destroy', $item->id) }}')"
                                                    class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg class="mx-auto h-12 w-12 text-zinc-300" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-zinc-900">Belum ada kategori</h3>
                        <p class="mt-1 text-sm text-zinc-500">Mulai dengan menambahkan kategori produk baru.</p>
                        <div class="mt-6">
                            <button @click="createModalOpen = true"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-comfy-800 hover:bg-comfy-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-comfy-800">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Kategori
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Pagination -->
                @if ($kategori->hasPages())
                    <div class="bg-white px-4 py-3 border-t border-zinc-200 sm:px-6">
                        {{ $kategori->links() }}
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
                class="fixed inset-0 bg-zinc-500/75 backdrop-blur-sm transition-opacity pointer-events-auto"></div>

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
                            <h3 class="text-base font-semibold leading-6 text-white" id="modal-title">Tambah Kategori
                            </h3>
                            <button @click="createModalOpen = false" class="text-comfy-200 hover:text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf
                            <div class="px-4 py-5 sm:p-6 space-y-4">
                                <!-- Nama Kategori -->
                                <div>
                                    <label for="kategori" class="block text-sm font-medium leading-6 text-zinc-900">Nama
                                        Kategori</label>
                                    <div class="mt-2">
                                        <input type="text" name="kategori" id="kategori" required
                                            class="block w-full rounded-md border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6"
                                            value="{{ old('kategori') }}">
                                        @error('kategori', 'storeKategori')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Deskripsi -->
                                <div>
                                    <label for="deskripsi"
                                        class="block text-sm font-medium leading-6 text-zinc-900">Deskripsi</label>
                                    <div class="mt-2">
                                        <textarea id="deskripsi" name="deskripsi" rows="3" required
                                            class="block w-full rounded-md border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi', 'storeKategori')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
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
                class="fixed inset-0 bg-zinc-500/75 backdrop-blur-sm transition-opacity pointer-events-auto"></div>

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
                            <h3 class="text-base font-semibold leading-6 text-white" id="modal-title">Edit Kategori
                            </h3>
                            <button @click="editModalOpen = false" class="text-comfy-200 hover:text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form x-bind:action="'/kategori/' + currentKategori.id" method="POST">
                            <input type="hidden" name="id" x-model="currentKategori.id">
                            @csrf
                            @method('PUT')
                            <div class="px-4 py-5 sm:p-6 space-y-4">
                                <!-- Nama Kategori -->
                                <div>
                                    <label for="edit_kategori"
                                        class="block text-sm font-medium leading-6 text-zinc-900">Nama Kategori</label>
                                    <div class="mt-2">
                                        <input type="text" name="kategori" id="edit_kategori"
                                            x-model="currentKategori.kategori" required
                                            class="block w-full rounded-md border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                        @error('kategori', 'updateKategori')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Deskripsi -->
                                <div>
                                    <label for="edit_deskripsi"
                                        class="block text-sm font-medium leading-6 text-zinc-900">Deskripsi</label>
                                    <div class="mt-2">
                                        <textarea id="edit_deskripsi" name="deskripsi" rows="3" x-model="currentKategori.deskripsi" required
                                            class="block w-full rounded-md border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6"></textarea>
                                        @error('deskripsi', 'updateKategori')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
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
                                        Kategori</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-zinc-500">Apakah Anda yakin ingin menghapus kategori ini?
                                            Data
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
