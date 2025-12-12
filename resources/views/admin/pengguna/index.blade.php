@extends('layouts.app')

@section('header')
    Manajemen Pengguna
@endsection

@section('content')
    <div x-data="{
        createModalOpen: false,
        editModalOpen: false,
        deleteModalOpen: false,
        currentUser: {
            id: null,
            name: '',
            email: '',
            role: '',
            password: ''
        },
        deleteUrl: '',
        editUrl: '',
        resetForm() {
            this.currentUser = {
                id: null,
                name: '',
                email: '',
                role: 'user', // Default role
                password: ''
            };
            this.editUrl = '';
        },
        editUser(item) {
            this.currentUser = {
                id: item.id,
                name: item.name,
                email: item.email,
                role: item.role,
                password: '' // Don't fill password on edit
            };
            this.editUrl = '/pengguna/' + item.id;
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
                <form action="{{ route('pengguna.index') }}" method="GET" class="w-full sm:max-w-xs relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="block w-full pl-10 pr-3 py-2 border border-zinc-200 rounded-lg leading-5 bg-white placeholder-zinc-400 focus:outline-none focus:placeholder-zinc-300 focus:border-comfy-800 focus:ring-comfy-800 sm:text-sm transition duration-150 ease-in-out"
                        placeholder="Cari pengguna...">
                </form>

                <div class="flex items-center gap-3">
                    <button @click="createModalOpen = true; resetForm()" type="button"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-comfy-800 hover:bg-comfy-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-comfy-800 transition-all">
                        <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Pengguna
                    </button>
                </div>
            </div>

            <!-- Table Content -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                @if ($user->count() > 0)
                    <!-- Modern Grid Cards Layout -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6 bg-zinc-50/50">
                        @foreach ($user as $item)
                            <div
                                class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 flex flex-col hover:shadow-md transition-all duration-300 group">
                                <div class="flex justify-between items-start mb-4">
                                    <!-- Icon Decorator -->
                                    <div
                                        class="p-3 bg-comfy-50 rounded-xl text-comfy-800 group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                    </div>

                                    <!-- Actions -->
                                    <div
                                        class="flex items-center gap-1 opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity duration-200">
                                        <button
                                            @click="editUser({
                                                id: '{{ $item->id }}',
                                                name: '{{ addslashes($item->name) }}',
                                                email: '{{ addslashes($item->email) }}',
                                                role: '{{ $item->role }}'
                                            })"
                                            class="p-2 text-zinc-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button @click="confirmDelete('{{ route('pengguna.destroy', $item->id) }}')"
                                            class="p-2 text-zinc-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                            title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h3 class="text-lg font-bold text-zinc-900 mb-1">{{ $item->name }}</h3>
                                    <p class="text-sm text-zinc-500 mb-2">
                                        {{ $item->email }}
                                    </p>
                                    <span
                                        class="inline-flex items-center rounded-md bg-zinc-50 px-2 py-1 text-xs font-medium text-zinc-600 ring-1 ring-inset ring-zinc-500/10">
                                        {{ ucfirst($item->role) }}
                                    </span>
                                </div>

                                <div
                                    class="mt-auto pt-4 border-t border-zinc-100 flex items-center justify-between text-xs text-zinc-400">
                                    <span>Bergabung {{ $item->created_at->diffForHumans() }}</span>
                                    <span>#{{ $item->id }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg class="mx-auto h-12 w-12 text-zinc-300" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-zinc-900">Belum ada pengguna</h3>
                        <p class="mt-1 text-sm text-zinc-500">Mulai dengan menambahkan pengguna baru.</p>
                        <div class="mt-6">
                            <button @click="createModalOpen = true"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-comfy-800 hover:bg-comfy-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-comfy-800">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Pengguna
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Pagination -->
                @if ($user->hasPages())
                    <div class="bg-white px-4 py-3 border-t border-zinc-200 sm:px-6">
                        {{ $user->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Create Modal -->
        <div x-show="createModalOpen" class="relative z-50 pointer-events-none" aria-labelledby="modal-title" role="dialog"
            aria-modal="true" x-cloak>
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
                            <h3 class="text-base font-semibold leading-6 text-white" id="modal-title">Tambah Pengguna
                            </h3>
                            <button @click="createModalOpen = false" class="text-comfy-200 hover:text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('pengguna.store') }}" method="POST">
                            @csrf
                            <div class="px-4 py-5 sm:p-6 space-y-4">
                                <!-- Nama -->
                                <div>
                                    <label for="name" class="block text-sm font-medium leading-6 text-zinc-900">Nama
                                        Lengkap</label>
                                    <div class="mt-2">
                                        <input type="text" name="name" id="name" required
                                            class="block w-full rounded-md border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium leading-6 text-zinc-900">Email</label>
                                    <div class="mt-2">
                                        <input type="email" name="email" id="email" required
                                            class="block w-full rounded-md border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="password"
                                        class="block text-sm font-medium leading-6 text-zinc-900">Password</label>
                                    <div class="mt-2">
                                        <input type="password" name="password" id="password" required
                                            class="block w-full rounded-md border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <!-- Role -->
                                <div>
                                    <label for="role"
                                        class="block text-sm font-medium leading-6 text-zinc-900">Role</label>
                                    <div class="mt-2">
                                        <select name="role" id="role" required <select name="role"
                                            id="role" required
                                            class="block w-full rounded-md border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
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
                            <h3 class="text-base font-semibold leading-6 text-white" id="modal-title">Edit Pengguna
                            </h3>
                            <button @click="editModalOpen = false" class="text-comfy-200 hover:text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form :action="editUrl" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="px-4 py-5 sm:p-6 space-y-4">
                                <!-- Nama -->
                                <div>
                                    <label for="edit_name" class="block text-sm font-medium leading-6 text-zinc-900">Nama
                                        Lengkap</label>
                                    <div class="mt-2">
                                        <input type="text" name="name" id="edit_name" x-model="currentUser.name"
                                            required
                                            class="block w-full rounded-md border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="edit_email"
                                        class="block text-sm font-medium leading-6 text-zinc-900">Email</label>
                                    <div class="mt-2">
                                        <input type="email" name="email" id="edit_email" x-model="currentUser.email"
                                            required
                                            class="block w-full rounded-md border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="edit_password" class="block text-sm font-medium leading-6 text-zinc-900">
                                        Password <span class="text-zinc-400 font-normal">(kosongkan jika tidak ubah)</span>
                                    </label>
                                    <div class="mt-2">
                                        <input type="password" name="password" id="edit_password"
                                            class="block w-full rounded-md border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <!-- Role -->
                                <div>
                                    <label for="edit_role"
                                        class="block text-sm font-medium leading-6 text-zinc-900">Role</label>
                                    <div class="mt-2">
                                        <select name="role" id="edit_role" x-model="currentUser.role" required
                                            class="block w-full rounded-md border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
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
                                        Pengguna</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-zinc-500">Apakah Anda yakin ingin menghapus pengguna ini?
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
