<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopupadminController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing.home');
Route::get('/katalog', [LandingController::class, 'produk'])->name('landing.produk');
Route::get('/produk/{produk}', [LandingController::class, 'show'])->name('landing.detail');
Route::get('/profil', [LandingController::class, 'profil'])->name('landing.profil');
Route::get('/keranjang', [LandingController::class, 'keranjang'])->name('landing.keranjang');
Route::post('/keranjang/add/{id}', [LandingController::class, 'addToCart'])->name('cart.add');
Route::delete('/keranjang/remove/{id}', [LandingController::class, 'removeFromCart'])->name('cart.remove');
// Top Up routes
Route::post('/topup/callback', [TopupController::class, 'callback'])->name('topup.callback');
Route::get('/topup/finish', [TopupController::class, 'finish'])->name('topup.finish');
Route::resource('topup', TopupController::class);

Route::middleware(IsAdmin::class)->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('produk', ProdukController::class)->except(['show']);
    Route::resource('kategori', KategoriController::class);
    Route::resource('pengguna', UserController::class);
    Route::resource('topup-admin', TopupadminController::class);
});
