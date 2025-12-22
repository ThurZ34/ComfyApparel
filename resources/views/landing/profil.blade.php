@extends('layouts.landing')

@section('title', 'My Profile - ComfyApparel')
@section('body-class', 'bg-zinc-50')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div x-data="{ activeTab: 'overview' }" class="flex flex-col lg:flex-row gap-8">

            <!-- Left Sidebar (User Profile & Nav) -->
            <aside class="w-full lg:w-72 flex-shrink-0 space-y-6">
                <!-- User Card -->
                <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-comfy-800"></div>
                    <div
                        class="w-20 h-20 mx-auto bg-zinc-100 rounded-full flex items-center justify-center text-2xl font-bold text-zinc-500 mb-4 ring-4 ring-white shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <h2 class="font-bold text-lg text-zinc-900 truncate">{{ Auth::user()->name }}</h2>
                    <p class="text-xs text-zinc-500 truncate mb-6">{{ Auth::user()->email }}</p>

                    <div class="pt-6 border-t border-zinc-100">
                        <p class="text-xs text-zinc-400 uppercase tracking-wider mb-2 font-semibold">Active Balance</p>
                        <p class="text-2xl font-serif font-bold text-comfy-800">Rp
                            {{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }}</p>
                        <a href="{{ route('topup.index') }}"
                            class="mt-4 block w-full py-2.5 bg-zinc-900 text-white text-xs font-bold rounded-xl hover:bg-zinc-800 transition-all hover:shadow-lg hover:shadow-zinc-800/20">
                            + Top Up Balance
                        </a>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="bg-white rounded-2xl p-2 border border-zinc-100 shadow-sm flex flex-col gap-1">
                    <button @click="activeTab = 'overview'"
                        :class="activeTab === 'overview' ? 'bg-comfy-50 text-comfy-900 font-semibold' :
                            'text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900'"
                        class="w-full text-left px-4 py-3 rounded-xl text-sm transition-all flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                        Overview
                    </button>
                    <button @click="activeTab = 'orders'"
                        :class="activeTab === 'orders' ? 'bg-comfy-50 text-comfy-900 font-semibold' :
                            'text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900'"
                        class="w-full text-left px-4 py-3 rounded-xl text-sm transition-all flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 5c.07.286.074.58.012.868-.568 2.508-2.618 4.625-5.336 4.625H8.452c-2.718 0-4.768-2.117-5.336-4.625-.062-.288-.058-.582.012-.868l1.263-5c.11-.439.42-.777.839-.908 1.956-.61 4.124-.61 6.08 0 .419.13.73.469.839.908z" />
                        </svg>
                        My Orders
                    </button>
                    <button @click="activeTab = 'topups'"
                        :class="activeTab === 'topups' ? 'bg-comfy-50 text-comfy-900 font-semibold' :
                            'text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900'"
                        class="w-full text-left px-4 py-3 rounded-xl text-sm transition-all flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V4.505c0-.986.993-1.638 1.902-1.383 2.181.61 5.397 2.457 7.078 6.942.338.904-.37 1.848-1.282 2.172l-1.07.382z" />
                        </svg>
                        Top Up History
                    </button>
                    <div class="h-px bg-zinc-100 my-1"></div>
                    <button @click="activeTab = 'settings'"
                        :class="activeTab === 'settings' ? 'bg-comfy-50 text-comfy-900 font-semibold' :
                            'text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900'"
                        class="w-full text-left px-4 py-3 rounded-xl text-sm transition-all flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 0a20.838 20.838 0 011.439-4.283c.267-.579.977-.78 1.527-.461l.657.38c.524.301.71.96.463 1.511a21.917 21.917 0 00-.985 2.783m2.406 13.633a2.362 2.362 0 01-1.928 2.985 2.362 2.362 0 01-2.985-1.928m2.985-1.928a23.36 23.36 0 01-4.908-1.448m4.908 1.448a2.362 2.362 0 011.928-2.985m-1.928 2.985a2.362 2.362 0 01-2.985 1.928" />
                        </svg>
                        Settings
                    </button>
                </nav>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 min-w-0">

                <!-- Overview Tab -->
                <div x-show="activeTab === 'overview'" x-transition.opacity.duration.300ms class="space-y-6">
                    <h1 class="text-2xl font-serif font-bold text-zinc-900">Dashboard Overview</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div
                            class="bg-white p-6 rounded-2xl border border-zinc-100 shadow-sm flex items-center justify-between">
                            <div>
                                <p class="text-sm text-zinc-500 mb-1">Total Orders</p>
                                <p class="text-3xl font-bold text-zinc-900">{{ $transactions->count() }}</p>
                            </div>
                            <div class="p-3 bg-zinc-50 rounded-xl text-zinc-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 5c.07.286.074.58.012.868-.568 2.508-2.618 4.625-5.336 4.625H8.452c-2.718 0-4.768-2.117-5.336-4.625-.062-.288-.058-.582.012-.868l1.263-5c.11-.439.42-.777.839-.908 1.956-.61 4.124-.61 6.08 0 .419.13.73.469.839.908z" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="bg-white p-6 rounded-2xl border border-zinc-100 shadow-sm flex items-center justify-between">
                            <div>
                                <p class="text-sm text-zinc-500 mb-1">Member Since</p>
                                <p class="text-xl font-bold text-zinc-900">{{ Auth::user()->created_at->format('M Y') }}</p>
                            </div>
                            <div class="p-3 bg-zinc-50 rounded-xl text-zinc-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-2xl border border-zinc-100 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-zinc-100 flex justify-between items-center">
                            <h3 class="font-bold text-zinc-900">Recent Activity</h3>
                            <button @click="activeTab = 'orders'" class="text-sm text-comfy-600 hover:text-comfy-900">View
                                All</button>
                        </div>
                        @if ($transactions->count() > 0)
                            <div class="divide-y divide-zinc-100">
                                @foreach ($transactions->take(3) as $trx)
                                    <div class="p-4 flex items-center justify-between hover:bg-zinc-50 transition-colors">
                                        <div class="flex items-center gap-4">
                                            <div class="p-2 bg-comfy-50 text-comfy-600 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 5c.07.286.074.58.012.868-.568 2.508-2.618 4.625-5.336 4.625H8.452c-2.718 0-4.768-2.117-5.336-4.625-.062-.288-.058-.582.012-.868l1.263-5c.11-.439.42-.777.839-.908 1.956-.61 4.124-.61 6.08 0 .419.13.73.469.839.908z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-zinc-900">Order
                                                    #{{ substr($trx->kode_transaksi, 8) }}</p>
                                                <p class="text-xs text-zinc-500">{{ $trx->created_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-zinc-900">Rp
                                                {{ number_format($trx->total_harga, 0, ',', '.') }}</p>
                                            <p class="text-xs text-zinc-500 capitalize">{{ $trx->status }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-8 text-center text-zinc-500 text-sm">No recent activity</div>
                        @endif
                    </div>
                </div>

                <!-- Orders Tab -->
                <div x-show="activeTab === 'orders'" x-transition.opacity.duration.300ms>
                    <h1 class="text-2xl font-serif font-bold text-zinc-900 mb-6">My Orders</h1>
                    <div class="bg-white rounded-2xl border border-zinc-100 shadow-sm overflow-hidden">
                        @if ($transactions->count() > 0)
                            <table class="w-full text-left text-sm text-zinc-600">
                                <thead
                                    class="bg-zinc-50 border-b border-zinc-200 text-xs uppercase font-semibold text-zinc-500">
                                    <tr>
                                        <th class="px-6 py-4">Invoice</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4 text-right">Total</th>
                                        <th class="px-6 py-4"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-200">
                                    @foreach ($transactions as $trx)
                                        <tr class="hover:bg-zinc-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="font-medium text-zinc-900">{{ $trx->kode_transaksi }}</div>
                                                <div class="text-xs text-zinc-500">
                                                    {{ $trx->created_at->format('d M Y H:i') }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium 
                                                    {{ $trx->status === 'paid'
                                                        ? 'bg-green-100 text-green-800'
                                                        : ($trx->status === 'pending'
                                                            ? 'bg-yellow-100 text-yellow-800'
                                                            : ($trx->status === 'shipped'
                                                                ? 'bg-blue-100 text-blue-800'
                                                                : 'bg-zinc-100 text-zinc-800')) }}">
                                                    {{ ucfirst($trx->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right font-medium text-zinc-900">
                                                Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <a href="{{ route('transaksi.show', $trx->id) }}"
                                                    class="text-comfy-800 hover:text-comfy-600 font-medium text-xs">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-12 text-center text-zinc-500">
                                <p class="mb-4">You haven't placed any orders yet.</p>
                                <a href="{{ route('landing.produk') }}"
                                    class="inline-block px-6 py-2 bg-comfy-800 text-white rounded-lg text-sm font-medium hover:bg-comfy-900 transition-colors">Start
                                    Shopping</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Topups Tab -->
                <div x-show="activeTab === 'topups'" x-transition.opacity.duration.300ms>
                    <h1 class="text-2xl font-serif font-bold text-zinc-900 mb-6">Top Up History</h1>
                    <div class="bg-white rounded-2xl border border-zinc-100 shadow-sm overflow-hidden">
                        @if ($topups->count() > 0)
                            <table class="w-full text-left text-sm text-zinc-600">
                                <thead
                                    class="bg-zinc-50 border-b border-zinc-200 text-xs uppercase font-semibold text-zinc-500">
                                    <tr>
                                        <th class="px-6 py-4">Date</th>
                                        <th class="px-6 py-4">Amount</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4">Method</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-200">
                                    @foreach ($topups as $topup)
                                        <tr class="hover:bg-zinc-50 transition-colors">
                                            <td class="px-6 py-4 text-zinc-500">
                                                {{ $topup->created_at->format('d M Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-zinc-900">
                                                Rp {{ number_format($topup->amount, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium 
                                                    {{ $topup->status === 'success'
                                                        ? 'bg-green-100 text-green-800'
                                                        : ($topup->status === 'pending'
                                                            ? 'bg-yellow-100 text-yellow-800'
                                                            : 'bg-red-100 text-red-800') }}">
                                                    {{ ucfirst($topup->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-xs font-mono uppercase text-zinc-500">
                                                {{ $topup->payment_method ?? 'Payment' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-12 text-center text-zinc-500">
                                <p class="mb-4">No top up history found.</p>
                                <a href="{{ route('topup.index') }}"
                                    class="inline-block px-6 py-2 bg-comfy-50 text-comfy-800 rounded-lg text-sm font-medium hover:bg-comfy-100 transition-colors font-bold">+
                                    Top Up Now</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Settings Tab -->
                <div x-show="activeTab === 'settings'" x-transition.opacity.duration.300ms>
                    <h1 class="text-2xl font-serif font-bold text-zinc-900 mb-6">Settings</h1>
                    <div class="space-y-6">
                        <!-- Profile Info -->
                        <div class="bg-white p-6 rounded-2xl border border-zinc-100 shadow-sm">
                            <h2 class="font-bold text-zinc-900 mb-4">Personal Information</h2>
                            <form action="{{ route('user-profile-information.update') }}" method="POST"
                                class="grid gap-4">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="block text-xs font-medium text-zinc-700 mb-1">Full Name</label>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                                        class="w-full rounded-lg border-zinc-200 text-sm focus:ring-comfy-800 focus:border-comfy-800">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-zinc-700 mb-1">Email</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="w-full rounded-lg border-zinc-200 text-sm focus:ring-comfy-800 focus:border-comfy-800">
                                </div>
                                <div>
                                    <button type="submit"
                                        class="px-4 py-2 bg-zinc-900 text-white rounded-lg text-sm font-medium hover:bg-zinc-800">Save
                                        Profile</button>
                                </div>
                            </form>
                        </div>

                        <!-- Security -->
                        <div class="bg-white p-6 rounded-2xl border border-zinc-100 shadow-sm">
                            <h2 class="font-bold text-zinc-900 mb-4">Security</h2>
                            <form action="{{ route('user-password.update') }}" method="POST" class="grid gap-4">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="block text-xs font-medium text-zinc-700 mb-1">Current Password</label>
                                    <input type="password" name="current_password"
                                        class="w-full rounded-lg border-zinc-200 text-sm focus:ring-comfy-800 focus:border-comfy-800">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-zinc-700 mb-1">New Password</label>
                                        <input type="password" name="password"
                                            class="w-full rounded-lg border-zinc-200 text-sm focus:ring-comfy-800 focus:border-comfy-800">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-zinc-700 mb-1">Confirm
                                            Password</label>
                                        <input type="password" name="password_confirmation"
                                            class="w-full rounded-lg border-zinc-200 text-sm focus:ring-comfy-800 focus:border-comfy-800">
                                    </div>
                                </div>
                                <div>
                                    <button type="submit"
                                        class="px-4 py-2 bg-white border border-zinc-300 text-zinc-700 rounded-lg text-sm font-medium hover:bg-zinc-50">Update
                                        Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
