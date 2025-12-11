@extends('layouts.app')

@section('header')
    Dashboard Overview
@endsection

@section('content')
    <div class="space-y-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1: Comfy Theme (Primary) -->
            <div
                class="relative overflow-hidden bg-comfy-800 text-white p-6 rounded-2xl shadow-xl transform transition duration-300 hover:-translate-y-1 hover:shadow-2xl group">
                <div
                    class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 bg-white/10 rounded-full opacity-20 group-hover:scale-150 transition-transform duration-500">
                </div>

                <div class="flex items-center justify-between mb-4 relative z-10">
                    <h3 class="text-comfy-200 text-xs font-semibold uppercase tracking-wider">Total Revenue</h3>
                    <span class="p-2 bg-white/10 border border-white/10 rounded-lg text-comfy-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <p class="text-4xl font-bold tracking-tight mb-1 relative z-10">$45,231.89</p>
                <div class="mt-4 flex items-center text-sm relative z-10">
                    <span class="text-comfy-200 bg-white/10 px-2 py-0.5 rounded flex items-center gap-1 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                        20.1%
                    </span>
                    <span class="text-comfy-200/70 ml-2">from last month</span>
                </div>
            </div>

            <!-- Card 2: White Theme -->
            <div
                class="bg-white border border-zinc-100 p-6 rounded-2xl shadow-sm hover:border-comfy-500/30 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-zinc-500 text-xs font-semibold uppercase tracking-wider">Active Users</h3>
                    <span class="p-2 bg-comfy-50 rounded-lg text-comfy-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </span>
                </div>
                <p class="text-4xl font-bold text-zinc-900 tracking-tight">2,350</p>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-comfy-800 bg-comfy-50 px-2 py-0.5 rounded flex items-center gap-1 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                        180
                    </span>
                    <span class="text-zinc-400 ml-2">new users joined</span>
                </div>
            </div>

            <!-- Card 3: White Theme -->
            <div
                class="bg-white border border-zinc-100 p-6 rounded-2xl shadow-sm hover:border-comfy-500/30 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-zinc-500 text-xs font-semibold uppercase tracking-wider">Total Orders</h3>
                    <span class="p-2 bg-comfy-50 rounded-lg text-comfy-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </span>
                </div>
                <p class="text-4xl font-bold text-zinc-900 tracking-tight">12,234</p>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-comfy-800 bg-comfy-50 px-2 py-0.5 rounded flex items-center gap-1 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                        12%
                    </span>
                    <span class="text-zinc-400 ml-2">growth rate</span>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white border border-zinc-200 rounded-2xl shadow-sm">
            <div class="p-6 border-b border-zinc-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-zinc-900">Recent Transactions</h2>
                <button class="text-sm font-medium text-zinc-500 hover:text-black transition-colors">View All</button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-comfy-50/50 text-zinc-500 text-xs uppercase tracking-wider">
                            <th class="px-6 py-3 font-semibold">Transaction ID</th>
                            <th class="px-6 py-3 font-semibold">Customer</th>
                            <th class="px-6 py-3 font-semibold">Date</th>
                            <th class="px-6 py-3 font-semibold">Amount</th>
                            <th class="px-6 py-3 font-semibold text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @foreach (range(1, 5) as $i)
                            <tr class="group hover:bg-zinc-50 transition-colors">
                                <td class="px-6 py-4 text-zinc-900 font-medium whitespace-nowrap">
                                    #TRX-{{ 7820 + $i }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-linear-to-br from-comfy-50 to-comfy-200 border border-comfy-200 flex items-center justify-center text-xs font-bold text-comfy-800">
                                            {{ substr('Customer Two Three', $i, 1) }}
                                        </div>
                                        <div class="text-sm font-medium text-zinc-700">Customer {{ $i }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-zinc-500 text-sm whitespace-nowrap">
                                    {{ now()->subDays($i)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-zinc-900 font-semibold whitespace-nowrap">
                                    $1,{{ rand(100, 999) }}.00
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $i % 2 == 0 ? 'bg-comfy-800 text-white' : 'bg-zinc-100 text-zinc-600 border border-zinc-200' }}">
                                        {{ $i % 2 == 0 ? 'Completed' : 'Pending' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
