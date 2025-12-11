<x-guest-layout>
    <div class="flex min-h-screen">
        <!-- Left Side: Login Form -->
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

                    <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-zinc-900">Sign in to your account
                    </h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-500">
                        Not a member?
                        <a href="{{ route('register') }}"
                            class="font-semibold text-comfy-800 hover:text-comfy-500 hover:underline transition-all">Sign
                            up now</a>
                    </p>
                </div>

                <div class="mt-10">
                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf

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
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="p-4 block w-full rounded-md border-0 py-2.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-500 sm:text-sm sm:leading-6 transition-all">
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember" type="checkbox"
                                    class="h-4 w-4 rounded border-zinc-300 text-comfy-800 focus:ring-comfy-500">
                                <label for="remember-me" class="ml-3 block text-sm leading-6 text-zinc-700">Remember
                                    me</label>
                            </div>

                            <div class="text-sm leading-6">
                                <a href="#"
                                    class="font-semibold text-comfy-800 hover:text-comfy-500 hover:underline transition-all">Forgot
                                    password?</a>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="flex w-full justify-center rounded-md bg-comfy-800 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-comfy-800/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-comfy-800 transition-all duration-300 transform hover:scale-[1.02]">
                                Sign in
                            </button>
                        </div>
                    </form>

                    <!-- Divider -->
                    <div class="mt-10">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-zinc-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm font-medium leading-6">
                                <span class="bg-white px-6 text-zinc-500">Or continue with</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <a href="#"
                                class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 focus-visible:ring-transparent">
                                <svg class="h-5 w-5" aria-hidden="true" viewBox="0 0 24 24">
                                    <path
                                        d="M12.0003 20.4144C16.6467 20.4144 20.4147 16.6464 20.4147 12.0001C20.4147 7.35371 16.6467 3.58569 12.0003 3.58569C7.35393 3.58569 3.58594 7.35371 3.58594 12.0001C3.58594 16.6464 7.35393 20.4144 12.0003 20.4144Z"
                                        fill="currentColor" fill-opacity="0" />
                                    <path
                                        d="M12.0002 9.20813V12.0001H15.6562C15.4952 13.0451 14.5362 14.9361 12.0002 14.9361C9.9192 14.9361 8.2192 13.2541 8.2192 11.2001C8.2192 9.14613 9.9192 7.46413 12.0002 7.46413C13.2122 7.46413 14.0202 7.98613 14.4842 8.43213L16.4842 6.50213C15.2282 5.33613 13.6702 4.70013 12.0002 4.70013C7.9682 4.70013 4.7002 7.96813 4.7002 12.0001C4.7002 16.0321 7.9682 19.3001 12.0002 19.3001C16.0322 19.3001 19.3002 16.0321 19.3002 12.0001C19.3002 11.5321 19.2562 11.1001 19.1842 10.7001H12.0002V9.20813Z"
                                        fill="#1F2937" />
                                </svg>
                                <span class="text-sm font-semibold leading-6">Google</span>
                            </a>

                            <a href="#"
                                class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 focus-visible:ring-transparent">
                                <svg class="h-5 w-5 text-[#181717]" enable-background="new 0 0 24 24"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m12 .5c-6.63 0-12 5.28-12 11.792 0 5.211 3.438 9.63 8.205 11.188.6.111.82-.254.82-.567 0-.28-.01-1.022-.015-2.005-3.338.711-4.042-1.582-4.042-1.582-.546-1.361-1.335-1.725-1.335-1.725-1.087-.731.084-.716.084-.716 1.205.084 1.838 1.213 1.838 1.213 1.07 1.803 2.809 1.282 3.495.981.108-.763.417-1.282.76-1.577-2.665-.295-5.466-1.309-5.466-5.827 0-1.287.465-2.339 1.235-3.164-.135-.298-.54-1.497.105-3.121 0 0 .99-.311 3.246 1.204.964-.263 1.98-.396 2.982-.401 1.002.005 2.019.138 2.984.401 2.254-1.515 3.243-1.204 3.243-1.204.647 1.624.242 2.823.12 3.121.77.825 1.235 1.877 1.235 3.164 0 4.53-2.805 5.527-5.475 5.817.42.354.81 1.077.81 2.182 0 1.578-.015 2.846-.015 3.229 0 .309.21.678.825.56 4.801-1.548 8.199-5.974 8.199-11.183 0-6.512-5.37-11.792-11.792-11.792z"
                                        fill="currentColor" />
                                </svg>
                                <span class="text-sm font-semibold leading-6">GitHub</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Image -->
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('images/auth-bg.png') }}"
                alt="Comfy Apparel Aesthetic">
            <!-- Overlay to blend slightly -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent mix-blend-multiply"></div>
        </div>
    </div>
</x-guest-layout>
