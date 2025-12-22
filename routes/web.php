<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StoreSettingController;
use App\Http\Controllers\TopupadminController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksilogController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing.home');
Route::get('/katalog', [LandingController::class, 'produk'])->name('landing.produk');
Route::get('/produk/{produk}', [LandingController::class, 'show'])->name('landing.detail');
Route::get('/profil', [LandingController::class, 'profil'])->name('landing.profil');
Route::get('/keranjang', [LandingController::class, 'keranjang'])->name('landing.keranjang');
Route::post('/keranjang/add/{id}', [LandingController::class, 'addToCart'])->name('cart.add');
Route::patch('/keranjang/update/{id}', [LandingController::class, 'updateCart'])->name('cart.update');
Route::delete('/keranjang/remove/{id}', [LandingController::class, 'removeFromCart'])->name('cart.remove');

// Top Up routes
Route::post('/topup/callback', [TopupController::class, 'callback'])->name('topup.callback');
Route::get('/topup/finish', [TopupController::class, 'finish'])->name('topup.finish');
Route::resource('topup', TopupController::class);

// Transaksi routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{transaksi}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::post('/transaksi/{transaksi}/cancel', [TransaksiController::class, 'cancel'])->name('transaksi.cancel');
});

Route::middleware(IsAdmin::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('produk', ProdukController::class)->except(['show']);
    Route::resource('kategori', KategoriController::class);
    Route::resource('pengguna', UserController::class);
    Route::resource('topup-admin', TopupadminController::class);
    Route::resource('transaksi_log', TransaksilogController::class);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // Store Settings
    Route::get('/pengaturan', [StoreSettingController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [StoreSettingController::class, 'update'])->name('pengaturan.update');
});
