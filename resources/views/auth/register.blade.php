<x-guest-layout>
    <div class="flex min-h-screen">
        <!-- Left Side: Register Form -->
        <div
            class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white w-full lg:w-1/2">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <div class="flex items-center gap-2 mb-8">
                        <div class="bg-comfy-800 text-white p-1.5 rounded-lg shadow-sm shadow-comfy-800/20">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                        </div>
                        <span class="font-bold text-xl text-comfy-800 tracking-tight">ComfyApparel</span>
                    </div>

                    <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-zinc-900">Create your account</h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-500">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="font-semibold text-comfy-800 hover:text-comfy-500 hover:underline transition-all">Sign
                            in here</a>
                    </p>
                </div>

                <div class="mt-10">
                    <form action="{{ route('register') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium leading-6 text-zinc-900">Full
                                Name</label>
                            <div class="mt-2">
                                <input id="name" name="name" type="text" autocomplete="name" required
                                    class="p-4 block w-full rounded-md border-0 py-2.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-500 sm:text-sm sm:leading-6 transition-all"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-zinc-900">Email
                                address</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    class="p-4 block w-full rounded-md border-0 py-2.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-500 sm:text-sm sm:leading-6 transition-all"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password"
                                class="block text-sm font-medium leading-6 text-zinc-900">Password</label>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="new-password"
                                    required
                                    class="p-4 block w-full rounded-md border-0 py-2.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-500 sm:text-sm sm:leading-6 transition-all">
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-medium leading-6 text-zinc-900">Confirm Password</label>
                            <div class="mt-2">
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    autocomplete="new-password" required
                                    class="p-4 block w-full rounded-md border-0 py-2.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-500 sm:text-sm sm:leading-6 transition-all">
                            </div>
                        </div>

                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" required
                                class="h-4 w-4 rounded border-zinc-300 text-comfy-800 focus:ring-comfy-500">
                            <label for="terms" class="ml-3 block text-sm leading-6 text-zinc-700">
                                I agree to the <a href="#"
                                    class="font-semibold text-comfy-800 hover:text-comfy-500 hover:underline">Terms of
                                    Service</a> and <a href="#"
                                    class="font-semibold text-comfy-800 hover:text-comfy-500 hover:underline">Privacy
                                    Policy</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="flex w-full justify-center rounded-md bg-comfy-800 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-comfy-800/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-comfy-800 transition-all duration-300 transform hover:scale-[1.02]">
                                Create Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Side: Image -->
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('images/auth-bg.png') }}"
                alt="Comfy Apparel Aesthetic">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent mix-blend-multiply"></div>
        </div>
    </div>
</x-guest-layout>
