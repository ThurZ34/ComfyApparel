@extends('layouts.app')

@section('header')
    Manajemen Top Up
@endsection

@section('content')
    <div x-data="{
        editModalOpen: false,
        currentTopup: {
            id: null,
            status: ''
        },
        updateStatus(item) {
            this.currentTopup = {
                id: item.id,
                status: item.status
            };
            this.editModalOpen = true;
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
                    <form action="{{ route('topup-admin.index') }}" method="GET">
                        <input type="text" name="query"
                            class="block w-full pl-10 pr-3 py-2 border border-zinc-200 rounded-lg leading-5 bg-white placeholder-zinc-400 focus:outline-none focus:placeholder-zinc-300 focus:border-comfy-800 focus:ring-comfy-800 sm:text-sm transition duration-150 ease-in-out"
                            placeholder="Cari transaksi...">
                    </form>
                </div>
            </div>

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

            <!-- Table Content -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                @if ($topups->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-zinc-200">
                            <thead class="bg-zinc-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                        Order ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                        User
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                        Payment Method
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                        Approved At
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-zinc-200">
                                @foreach ($topups as $topup)
                                    <tr class="hover:bg-zinc-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900">
                                            {{ $topup->order_id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-8 w-8 rounded-full bg-comfy-100 flex items-center justify-center text-comfy-700 font-bold text-xs uppercase mr-3">
                                                    {{ substr($topup->user->name ?? 'U', 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-zinc-900">
                                                        {{ $topup->user->name ?? 'Unknown' }}
                                                    </div>
                                                    <div class="text-xs text-zinc-500">
                                                        {{ $topup->user->email ?? '' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-zinc-900">
                                            Rp {{ number_format($topup->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                            {{ $topup->payment_method ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                            {{ $topup->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                            {{ $topup->approved_at ? $topup->approved_at->format('d M Y H:i') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @php
                                                $statusClass = match ($topup->status) {
                                                    'success'
                                                        => 'bg-green-100 text-green-800 border-green-200 ring-green-600/20',
                                                    'pending'
                                                        => 'bg-yellow-100 text-yellow-800 border-yellow-200 ring-yellow-600/20',
                                                    'failed'
                                                        => 'bg-red-100 text-red-800 border-red-200 ring-red-600/20',
                                                    default
                                                        => 'bg-zinc-100 text-zinc-800 border-zinc-200 ring-zinc-500/10',
                                                };
                                            @endphp
                                            <span
                                                class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $statusClass }}">
                                                {{ ucfirst($topup->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <button
                                                @click="updateStatus({ id: '{{ $topup->id }}', status: '{{ $topup->status }}' })"
                                                class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-lg transition-colors"
                                                title="Update Status">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </button>
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
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-zinc-900">Belum ada transaksi</h3>
                        <p class="mt-1 text-sm text-zinc-500">Transaksi top up akan muncul di sini.</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            {{-- <div class="mt-4">
                {{ $topups->links() }}
            </div> --}}
        </div>

        <!-- Edit Modal (Status Update) -->
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
                            <h3 class="text-base font-semibold leading-6 text-white" id="modal-title">Update Status Topup
                            </h3>
                            <button @click="editModalOpen = false" class="text-comfy-200 hover:text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Form Placeholder -->
                        <form x-bind:action="'/topup-admin/' + currentTopup.id" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="px-4 py-5 sm:p-6 space-y-4">
                                <div>
                                    <label for="status"
                                        class="block text-sm font-medium leading-6 text-zinc-900">Status</label>
                                    <select id="status" name="status" x-model="currentTopup.status"
                                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-zinc-900 ring-1 ring-inset ring-zinc-300 focus:ring-2 focus:ring-comfy-800 sm:text-sm sm:leading-6">
                                        <option value="pending">Pending</option>
                                        <option value="success">Success</option>
                                        <option value="failed">Failed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="bg-zinc-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="submit"
                                    class="inline-flex w-full justify-center rounded-md bg-comfy-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-comfy-900 sm:ml-3 sm:w-auto">Update
                                    Status</button>
                                <button type="button" @click="editModalOpen = false"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 sm:mt-0 sm:w-auto">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
