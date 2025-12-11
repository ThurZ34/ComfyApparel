<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('produk', App\Http\Controllers\ProdukController::class);
});

Route::get('/', function () {
    return view('landing.home');
});