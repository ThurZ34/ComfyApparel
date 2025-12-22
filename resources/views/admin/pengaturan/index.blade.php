@extends('layouts.app')

@section('header')
    Pengaturan Toko
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat error:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Settings Form --}}
        <div class="bg-white shadow-sm rounded-xl border border-zinc-200 overflow-hidden">
            {{-- Header --}}
            <div class="bg-comfy-800 px-6 py-4">
                <h2 class="text-lg font-semibold text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.204-.107-.397.165-.71.505-.78.929l-.15.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Pengaturan Toko
                </h2>
                <p class="text-comfy-200 text-sm mt-1">Kelola informasi toko yang akan ditampilkan di landing page</p>
            </div>

            <form action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data" class="p-6"
                x-data="{
                    logoPreview: '{{ $setting->logo ? Storage::url($setting->logo) : '' }}',
                    previewLogo(event) {
                        const file = event.target.files[0];
                        if (file) {
                            this.logoPreview = URL.createObjectURL(file);
                        }
                    }
                }">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    {{-- Logo Section --}}
                    <div>
                        <label class="block text-sm font-medium text-zinc-900 mb-3">Logo Toko</label>
                        <div class="flex items-start gap-6">
                            {{-- Logo Preview --}}
                            <div class="flex-shrink-0">
                                <div
                                    class="w-32 h-32 rounded-xl border-2 border-dashed border-zinc-300 bg-zinc-50 flex items-center justify-center overflow-hidden">
                                    <template x-if="logoPreview">
                                        <img :src="logoPreview" alt="Logo Preview" class="w-full h-full object-contain">
                                    </template>
                                    <template x-if="!logoPreview">
                                        <div class="text-center p-4">
                                            <svg class="mx-auto h-10 w-10 text-zinc-400" stroke="currentColor"
                                                fill="none" viewBox="0 0 48 48">
                                                <path
                                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <p class="mt-1 text-xs text-zinc-500">Tidak ada logo</p>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            {{-- Upload Input --}}
                            <div class="flex-1">
                                <div
                                    class="relative rounded-lg border border-zinc-300 bg-white px-6 py-10 text-center hover:border-comfy-500 transition-colors cursor-pointer">
                                    <input type="file" name="logo" id="logo" accept="image/*"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                        @change="previewLogo($event)">
                                    <svg class="mx-auto h-10 w-10 text-zinc-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-2 text-sm text-zinc-600">
                                        <span class="font-semibold text-comfy-800">Klik untuk upload</span> atau drag &
                                        drop
                                    </p>
                                    <p class="mt-1 text-xs text-zinc-500">PNG, JPG, WEBP (Maks. 2MB)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-zinc-200">

                    {{-- Store Name --}}
                    <div>
                        <label for="store_name" class="block text-sm font-medium text-zinc-900 mb-2">Nama
                            Toko <span class="text-red-500">*</span></label>
                        <input type="text" name="store_name" id="store_name"
                            value="{{ old('store_name', $setting->store_name) }}" required
                            class="block w-full rounded-lg border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm"
                            placeholder="Masukkan nama toko">
                    </div>

                    {{-- WhatsApp --}}
                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-zinc-900 mb-2">Kontak
                            WhatsApp</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-zinc-400" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                            </div>
                            <input type="text" name="whatsapp" id="whatsapp"
                                value="{{ old('whatsapp', $setting->whatsapp) }}"
                                class="block w-full rounded-lg border-0 py-3 pl-10 pr-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm"
                                placeholder="Contoh: 6281234567890">
                        </div>
                        <p class="mt-1 text-xs text-zinc-500">Masukkan nomor dengan format internasional (tanpa + atau
                            spasi)</p>
                    </div>

                    {{-- Address --}}
                    <div>
                        <label for="address" class="block text-sm font-medium text-zinc-900 mb-2">Alamat
                            Toko</label>
                        <textarea name="address" id="address" rows="3"
                            class="block w-full rounded-lg border-0 py-3 px-4 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-comfy-800 sm:text-sm"
                            placeholder="Masukkan alamat lengkap toko">{{ old('address', $setting->address) }}</textarea>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-semibold rounded-lg shadow-sm text-white bg-comfy-800 hover:bg-comfy-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-comfy-800 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
