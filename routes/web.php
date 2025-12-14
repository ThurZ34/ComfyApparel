<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing.home');
Route::get('/katalog', [LandingController::class, 'produk'])->name('landing.produk');
Route::get('/produk/{produk}', [LandingController::class, 'show'])->name('landing.detail');
Route::get('/profil', [LandingController::class, 'profil'])->name('landing.profil');
Route::get('/keranjang', [LandingController::class, 'keranjang'])->name('landing.keranjang');

Route::middleware(IsAdmin::class)->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('produk', ProdukController::class)->except(['show']);
    Route::resource('kategori', KategoriController::class);
    Route::resource('pengguna', UserController::class);
});
