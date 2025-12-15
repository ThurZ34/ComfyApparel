@extends('layouts.landing')

@section('title', 'My Profile - ComfyApparel')
@section('body-class', 'bg-zinc-50')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-zinc-100">
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
                    <div class="mb-4 sm:mb-2">
                        <span
                            class="px-4 py-1.5 rounded-full text-sm font-semibold bg-comfy-50 text-comfy-800 border border-comfy-100 shadow-sm capitalize">
                            {{ Auth::user()->role ?? 'Customer' }}
                        </span>
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
                        {{-- <button @click="tab = 'orders'"
                            :class="tab === 'orders' ? 'border-comfy-800 text-comfy-800' :
                                'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300'"
                            class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm transition-colors">
                            Order History
                        </button> --}}
                    </nav>
                </div>

                <!-- Profile Content -->
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
                                            <label for="name" class="block text-sm font-medium text-zinc-700 mb-1">Full
                                                Name</label>
                                            <input type="text" name="name" id="name"
                                                value="{{ Auth::user()->name }}"
                                                class="w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 text-sm py-3 px-4">
                                            @error('name')
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-zinc-700 mb-1">Email
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
                                <form action="{{ route('user-password.update') }}" method="POST" class="space-y-4">
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
                                            <label for="password" class="block text-sm font-medium text-zinc-700 mb-1">New
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
                                            <input type="password" name="password_confirmation" id="password_confirmation"
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

                    <!-- Right Column: Stats / Deletion -->
                    <div class="space-y-8">
                        <!-- Account Summary -->
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
                                    <span class="text-sm text-zinc-600">Total Orders</span>
                                    <span class="text-sm font-medium text-zinc-900">0</span>
                                </div>
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-sm text-zinc-600">Wishlist Items</span>
                                    <span class="text-sm font-medium text-zinc-900">0</span>
                                </div>
                            </div>
                        </section>

                        <!-- Delete Account -->
                        {{-- <section>
                            <h2 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h2>
                            <div class="bg-red-50 rounded-xl p-6 border border-red-100 text-center">
                                <p class="text-xs text-red-600/80 mb-4 leading-relaxed">
                                    Once you delete your account, there is no going back. Please be certain.
                                </p>
                                <button class="w-full px-4 py-2 bg-white border border-red-200 text-red-600 text-sm font-medium rounded-lg hover:bg-red-50 hover:border-red-300 transition-colors shadow-sm">
                                    Delete Account
                                </button>
                            </div>
                        </section> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
