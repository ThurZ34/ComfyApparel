<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Models\Produk;
use App\Models\Kategori;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    $produks = Produk::with('kategori')->latest()->take(8)->get();
    $kategoris = Kategori::addSelect(['gambar_terbaru' => Produk::select('gambar')
        ->whereColumn('kategori_id', 'kategoris.id')
        ->latest()
        ->limit(1)
    ])->get();
    return view('landing.home', compact('produks', 'kategoris'));
});

Route::middleware(IsAdmin::class)->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('produk', ProdukController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('pengguna', UserController::class);
});