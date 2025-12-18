@extends('layouts.app')

@section('header')
    Detail Transaksi #{{ $transaksi->kode_transaksi }}
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content (Left) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Items -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="px-6 py-4 bg-zinc-50 border-b border-zinc-200">
                    <h3 class="text-lg font-medium text-zinc-900">Produk Dipesan</h3>
                </div>
                <div class="divide-y divide-zinc-100">
                    @foreach ($transaksi->details as $item)
                        <div class="p-6 flex items-start space-x-4">
                            <div class="shrink-0 w-20 h-20 bg-zinc-100 rounded-lg overflow-hidden border border-zinc-200">
                                @if ($item->produk && $item->produk->gambar)
                                    <img src="{{ asset('storage/' . $item->produk->gambar) }}" alt="{{ $item->nama_produk }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full text-zinc-400">
                                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base font-medium text-zinc-900">{{ $item->nama_produk }}</h4>
                                <p class="text-sm text-zinc-500 mt-1">Qty: {{ $item->quantity }} x Rp
                                    {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-base font-semibold text-comfy-800">Rp
                                    {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="bg-zinc-50 px-6 py-4 border-t border-zinc-200">
                    <div class="flex justify-between items-center">
                        <span class="text-base font-medium text-zinc-900">Total Pembayaran</span>
                        <span class="text-xl font-bold text-comfy-800">Rp
                            {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Shipping Info -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="px-6 py-4 bg-zinc-50 border-b border-zinc-200">
                    <h3 class="text-lg font-medium text-zinc-900">Informasi Pengiriman</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-1">Penerima</p>
                        <p class="text-base text-zinc-900 font-medium">{{ $transaksi->nama_penerima }}</p>
                        <p class="text-sm text-zinc-500">{{ $transaksi->no_telp_penerima }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-1">Alamat</p>
                        <p class="text-base text-zinc-900">{{ $transaksi->alamat_pengiriman }}</p>
                    </div>

                    @if ($transaksi->catatan)
                        <div class="md:col-span-2 bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                            <p class="text-xs font-semibold text-yellow-800 uppercase tracking-wider mb-1">Catatan Pembeli
                            </p>
                            <p class="text-sm text-yellow-900 italic">"{{ $transaksi->catatan }}"</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- History Logs -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="px-6 py-4 bg-zinc-50 border-b border-zinc-200">
                    <h3 class="text-lg font-medium text-zinc-900">Riwayat Perubahan Status</h3>
                </div>
                <div class="p-6">
                    <ul class="relative border-l-2 border-zinc-200 ml-3 space-y-6">
                        @foreach ($transaksi->logs->sortByDesc('created_at') as $log)
                            <li class="relative pl-6">
                                <span
                                    class="absolute -left-[9px] top-1 h-4 w-4 rounded-full bg-zinc-400 ring-4 ring-white"></span>
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start">
                                    <div>
                                        <p class="text-sm font-medium text-zinc-900">
                                            Status berubah:
                                            <span class="font-bold text-comfy-800">{{ ucfirst($log->status_lama) }}</span>
                                            &rarr;
                                            <span class="font-bold text-comfy-800">{{ ucfirst($log->status_baru) }}</span>
                                        </p>
                                        @if ($log->catatan)
                                            <p class="text-sm text-zinc-600 mt-1 italic">"{{ $log->catatan }}"</p>
                                        @endif
                                        <p class="text-xs text-zinc-500 mt-1">Oleh: {{ $log->admin->name ?? 'System' }}</p>
                                    </div>
                                    <span
                                        class="text-xs text-zinc-400 mt-1 sm:mt-0">{{ $log->created_at->format('d M Y H:i') }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sidebar Content (Right) -->
        <div class="space-y-6">
            <!-- Update Status Form -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="px-6 py-4 bg-comfy-800 border-b border-comfy-900">
                    <h3 class="text-lg font-medium text-white">Update Status Transaksi</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('transaksi_log.update', ['transaksi_log' => $transaksi->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-zinc-700 mb-1">Status
                                    Baru</label>
                                <select name="status" id="status"
                                    class="block w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 sm:text-sm"
                                    onchange="toggleResiField()">
                                    <option value="pending" {{ $transaksi->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="paid" {{ $transaksi->status == 'paid' ? 'selected' : '' }}>Paid
                                    </option>
                                    <option value="processing" {{ $transaksi->status == 'processing' ? 'selected' : '' }}>
                                        Processing</option>
                                    <option value="shipped" {{ $transaksi->status == 'shipped' ? 'selected' : '' }}>Shipped
                                    </option>
                                    <option value="completed" {{ $transaksi->status == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="cancelled" {{ $transaksi->status == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>
                            </div>

                            <!-- Resi Field (Hidden by default unless shipped) -->
                            <div id="resi-container"
                                class="{{ $transaksi->status == 'shipped' ? '' : 'hidden' }} space-y-4 bg-zinc-50 p-4 rounded-lg border border-zinc-200">
                                <div>
                                    <label for="kurir" class="block text-sm font-medium text-zinc-700 mb-1">Kurir /
                                        Ekspedisi</label>
                                    <input type="text" name="kurir" id="kurir"
                                        value="{{ old('kurir', $transaksi->kurir) }}"
                                        class="block w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 sm:text-sm"
                                        placeholder="Contoh: JNE, J&T">
                                </div>
                                <div>
                                    <label for="no_resi" class="block text-sm font-medium text-zinc-700 mb-1">Nomor Resi
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" name="no_resi" id="no_resi"
                                        value="{{ old('no_resi', $transaksi->no_resi) }}"
                                        class="block w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 sm:text-sm"
                                        placeholder="Masukkan No Resi">
                                    <p class="text-xs text-zinc-500 mt-1">Wajib diisi jika status Shipped</p>
                                </div>
                            </div>

                            <!-- Catatan Admin -->
                            <div>
                                <label for="catatan" class="block text-sm font-medium text-zinc-700 mb-1">Catatan Admin
                                    (Log)</label>
                                <textarea name="catatan" id="catatan" rows="2"
                                    class="block w-full rounded-lg border-zinc-300 shadow-sm focus:border-comfy-800 focus:ring-comfy-800 sm:text-sm"
                                    placeholder="Alasan perubahan status..."></textarea>
                            </div>

                            <button type="submit"
                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-comfy-800 hover:bg-comfy-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-comfy-800">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Buyer Info -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                <div class="px-6 py-4 bg-zinc-50 border-b border-zinc-200">
                    <h3 class="text-lg font-medium text-zinc-900">Info Pembeli</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div
                            class="shrink-0 h-12 w-12 rounded-full bg-comfy-100 flex items-center justify-center text-comfy-800 font-bold text-xl">
                            {{ substr($transaksi->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-zinc-900">{{ $transaksi->user->name }}</h4>
                            <p class="text-xs text-zinc-500">Bergabung {{ $transaksi->user->created_at->format('M Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-zinc-500">Email:</span>
                            <span class="text-zinc-900">{{ $transaksi->user->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-zinc-500">No. HP:</span>
                            <span class="text-zinc-900">{{ $transaksi->user->phone ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-zinc-500">Saldo Akhir:</span>
                            <span class="text-comfy-800 font-bold">Rp
                                {{ number_format($transaksi->user->balance, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('transaksi_log.index') }}"
                    class="text-sm font-medium text-zinc-500 hover:text-zinc-700">
                    &larr; Kembali ke Daftar Transaksi
                </a>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function toggleResiField() {
                const status = document.getElementById('status').value;
                const resiContainer = document.getElementById('resi-container');
                const resiInput = document.getElementById('no_resi');

                if (status === 'shipped') {
                    resiContainer.classList.remove('hidden');
                    resiInput.required = true;
                } else {
                    resiContainer.classList.add('hidden');
                    resiInput.required = false;
                }
            }
        </script>
    @endpush
@endsection
