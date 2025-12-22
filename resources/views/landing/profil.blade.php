@extends('layouts.landing')

@section('title', 'My Profile - ComfyApparel')
@section('body-class', 'bg-zinc-50')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-zinc-100 mb-8">
            <!-- Cover Image -->
            <div class="h-48 w-full bg-gradient-to-r from-comfy-800 to-comfy-600 relative">
                <div class="absolute inset-0 bg-black/10"></div>
            </div>

            <div class="relative px-6 pb-6">
                <!-- Profile Header (Avatar overlap) -->
                <div class="relative -mt-16 sm:-mt-20 flex flex-col sm:flex-row items-center sm:items-end gap-6 mb-8">
                    <div class="relative group">
                        <div
                            class="h-32 w-32 sm:h-40 sm:w-40 rounded-full border-4 border-white bg-zinc-200 overflow-hidden shadow-md flex items-center justify-center text-4xl font-bold text-zinc-400 select-none">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="text-center sm:text-left flex-1 mb-2">
                        <h1 class="text-3xl font-bold text-zinc-900 font-serif">{{ Auth::user()->name }}</h1>
                        <p class="text-zinc-500 font-medium">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="mb-4 sm:mb-2 text-right">
                        <span class="block text-xs text-zinc-500 uppercase tracking-wider font-semibold mb-1">Saldo
                            Active</span>
                        <div class="text-3xl font-bold text-comfy-800 font-serif">
                            Rp {{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }}
                        </div>
                        <a href="{{ route('topup.index') }}"
                            class="text-sm font-medium text-comfy-600 hover:text-comfy-800">
                            + Top Up Saldo
                        </a>
                    </div>
                </div>

                <!-- Tabs/Navigation -->
                <div class="border-b border-zinc-200 mb-8" x-data="{ tab: 'profile' }">
                    <nav class="-mb-px flex space-x-8 justify-center sm:justify-start" aria-label="Tabs">
                        <button @click="tab = 'profile'"
                            :class="tab === 'profile' ? 'border-comfy-800 text-comfy-800' :
                                'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300'"
                            class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm transition-colors">
                            Profile Settings
                        </button>
                        <button @click="tab = 'activity'"
                            :class="tab === 'activity' ? 'border-comfy-800 text-comfy-800' :
                                'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300'"
                            class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm transition-colors">
                            Aktivitas Saya
                        </button>
                    </nav>

                    <!-- Content Area -->
                    <div class="mt-8">
                        <!-- Profile Settings Tab -->
                        <div x-show="tab === 'profile'" x-cloak
                            class="space-y-8 animate-in fade-in slide-in-from-bottom-2 duration-500">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                                <!-- Left Column: Personal Info Form -->
                                <div class="lg:col-span-2 space-y-8">
                                    <!-- Basic Information -->
                                    <section>
                                        <h2 class="text-lg font-semibold text-zinc-900 mb-4 flex items-center gap-2">
                                            Basic Information
                                        </h2>
                                        <div class="bg-zinc-50 rounded-xl p-6 border border-zinc-100">
                                            <form action="{{ route('user-profile-information.update') }}" method="POST"
                                                class="space-y-4">
                                                @csrf
                                                @method('PUT')

                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                    <div>
                                                        <label for="name"
                                                            class="block text-sm font-medium text-zinc-700 mb-1">Full
                                                            Name</label>
                                                        <input type="text" name="name" id="name"
                                                            value="{{ Auth::user()->name }}"
                                                            class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-sm py-3 px-4">
                                                        @error('name')
                                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <label for="email"
                                                            class="block text-sm font-medium text-zinc-700 mb-1">Email
                                                            Address</label>
                                                        <input type="email" name="email" id="email"
                                                            value="{{ Auth::user()->email }}"
                                                            class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-sm py-3 px-4">
                                                        @error('email')
                                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="flex justify-end pt-2">
                                                    <button type="submit"
                                                        class="px-6 py-2.5 bg-comfy-800 text-white text-sm font-medium rounded-lg hover:bg-comfy-900 transition-colors shadow-sm shadow-comfy-800/20">
                                                        Save Changes
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </section>

                                    <!-- Password Update -->
                                    <section>
                                        <h2 class="text-lg font-semibold text-zinc-900 mb-4 flex items-center gap-2">
                                            Security
                                        </h2>
                                        <div class="bg-zinc-50 rounded-xl p-6 border border-zinc-100">
                                            <form action="{{ route('user-password.update') }}" method="POST"
                                                class="space-y-4">
                                                @csrf
                                                @method('PUT')

                                                <div>
                                                    <label for="current_password"
                                                        class="block text-sm font-medium text-zinc-700 mb-1">Current
                                                        Password</label>
                                                    <input type="password" name="current_password" id="current_password"
                                                        class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-sm py-3 px-4">
                                                    @error('current_password', 'updatePassword')
                                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                    <div>
                                                        <label for="password"
                                                            class="block text-sm font-medium text-zinc-700 mb-1">New
                                                            Password</label>
                                                        <input type="password" name="password" id="password"
                                                            class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-sm py-3 px-4">
                                                        @error('password', 'updatePassword')
                                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <label for="password_confirmation"
                                                            class="block text-sm font-medium text-zinc-700 mb-1">Confirm
                                                            New Password</label>
                                                        <input type="password" name="password_confirmation"
                                                            id="password_confirmation"
                                                            class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-sm py-3 px-4">
                                                    </div>
                                                </div>

                                                <div class="flex justify-end pt-2">
                                                    <button type="submit"
                                                        class="px-6 py-2.5 bg-white border border-zinc-300 text-zinc-700 text-sm font-medium rounded-lg hover:bg-zinc-50 transition-colors shadow-sm">
                                                        Update Password
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </section>
                                </div>

                                <!-- Right Column: Stats -->
                                <div class="space-y-8">
                                    <section>
                                        <h2 class="text-lg font-semibold text-zinc-900 mb-4">Account Summary</h2>
                                        <div class="bg-zinc-50 rounded-xl p-6 border border-zinc-100 flex flex-col gap-4">
                                            <div class="flex items-center justify-between py-2 border-b border-zinc-200/50">
                                                <span class="text-sm text-zinc-600">Member Since</span>
                                                <span class="text-sm font-medium text-zinc-900">
                                                    {{ Auth::user()->created_at->format('M d, Y') }}
                                                </span>
                                            </div>
                                            <div class="flex items-center justify-between py-2 border-b border-zinc-200/50">
                                                <span class="text-sm text-zinc-600">Total Purchase</span>
                                                <span
                                                    class="text-sm font-medium text-zinc-900">{{ $transactions->count() }}
                                                    Orders</span>
                                            </div>
                                            <div class="flex items-center justify-between py-2">
                                                <span class="text-sm text-zinc-600">Total Top Ups</span>
                                                <span class="text-sm font-medium text-zinc-900">{{ $topups->count() }}
                                                    Times</span>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <!-- Activity Tab (Transactions & Topups) -->
                        <div x-show="tab === 'activity'" x-cloak
                            class="space-y-12 animate-in fade-in slide-in-from-bottom-2 duration-500">

                            <!-- Recent Transactions -->
                            <section>
                                <div class="flex items-center justify-between mb-6">
                                    <h2 class="text-xl font-serif font-bold text-comfy-800">Riwayat Belanja Terakhir</h2>
                                    <a href="{{ route('transaksi.index') }}"
                                        class="text-sm font-medium text-comfy-600 hover:text-comfy-800">
                                        Lihat Semua &rarr;
                                    </a>
                                </div>
                                <div class="bg-zinc-50 rounded-xl border border-zinc-100 overflow-hidden">
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-left text-sm text-zinc-600">
                                            <thead
                                                class="bg-zinc-100 border-b border-zinc-200 text-xs uppercase font-semibold text-zinc-500">
                                                <tr>
                                                    <th class="px-6 py-4">Invoice</th>
                                                    <th class="px-6 py-4">Tanggal</th>
                                                    <th class="px-6 py-4">Total</th>
                                                    <th class="px-6 py-4">Status</th>
                                                    <th class="px-6 py-4"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-zinc-200 bg-white">
                                                @forelse ($transactions as $trx)
                                                    <tr class="hover:bg-zinc-50 transition-colors group">
                                                        <td
                                                            class="px-6 py-4 font-mono text-xs text-zinc-500 group-hover:text-zinc-900 transition-colors">
                                                            {{ $trx->kode_transaksi }}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            {{ $trx->created_at->format('d M Y') }}
                                                        </td>
                                                        <td class="px-6 py-4 font-medium text-zinc-900">
                                                            Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            @if ($trx->status === 'paid')
                                                                <span
                                                                    class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Lunas</span>
                                                            @elseif ($trx->status === 'pending')
                                                                <span
                                                                    class="inline-flex items-center gap-1 rounded-full bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Pending</span>
                                                            @elseif ($trx->status === 'shipped')
                                                                <span
                                                                    class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20">Dikirim</span>
                                                            @else
                                                                <span
                                                                    class="inline-flex items-center gap-1 rounded-full bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 ring-1 ring-inset ring-zinc-500/10">{{ ucfirst($trx->status) }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="px-6 py-4 text-right">
                                                            <a href="{{ route('transaksi.show', $trx->id) }}"
                                                                class="text-comfy-600 hover:text-comfy-900 text-xs font-medium border border-comfy-100 bg-comfy-50 hover:bg-comfy-100 px-3 py-1.5 rounded-lg transition-colors">
                                                                Detail
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5"
                                                            class="px-6 py-12 text-center text-zinc-400 italic">
                                                            Belum ada transaksi pembelian.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>

                            <!-- Topup History -->
                            <section>
                                <div class="flex items-center justify-between mb-6">
                                    <h2 class="text-xl font-serif font-bold text-comfy-800">Riwayat Top Up Terakhir</h2>
                                    <a href="{{ route('topup.index') }}"
                                        class="text-sm font-medium text-comfy-600 hover:text-comfy-800">
                                        + Top Up Baru
                                    </a>
                                </div>
                                <div class="bg-zinc-50 rounded-xl border border-zinc-100 overflow-hidden">
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-left text-sm text-zinc-600">
                                            <thead
                                                class="bg-zinc-100 border-b border-zinc-200 text-xs uppercase font-semibold text-zinc-500">
                                                <tr>
                                                    <th class="px-6 py-4">Tanggal</th>
                                                    <th class="px-6 py-4">Nominal</th>
                                                    <th class="px-6 py-4">Via</th>
                                                    <th class="px-6 py-4">Status</th>
                                                    <th class="px-6 py-4">Approved At</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-zinc-200 bg-white">
                                                @forelse ($topups as $topup)
                                                    <tr class="hover:bg-zinc-50 transition-colors">
                                                        <td class="px-6 py-4">
                                                            {{ $topup->created_at->format('d M Y H:i') }}
                                                        </td>
                                                        <td class="px-6 py-4 font-medium text-zinc-900">
                                                            Rp {{ number_format($topup->amount, 0, ',', '.') }}
                                                        </td>
                                                        <td class="px-6 py-4 text-xs font-mono text-zinc-500 uppercase">
                                                            {{ $topup->payment_method ?? 'System' }}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            @if ($topup->status === 'success')
                                                                <span
                                                                    class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Berhasil</span>
                                                            @elseif ($topup->status === 'pending')
                                                                <span
                                                                    class="inline-flex items-center gap-1 rounded-full bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Pending</span>
                                                            @else
                                                                <span
                                                                    class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Gagal</span>
                                                            @endif
                                                        </td>
                                                        <td class="px-6 py-4 text-zinc-500 text-xs">
                                                            {{ $topup->approved_at ? $topup->approved_at->format('d/m/y H:i') : '-' }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5"
                                                            class="px-6 py-12 text-center text-zinc-400 italic">
                                                            Belum ada riwayat top up.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
