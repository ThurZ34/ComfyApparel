<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $produks = Produk::with('kategori')->latest()->take(8)->get();
    $kategoris = Kategori::addSelect(['gambar_terbaru' => Produk::select('gambar')
        ->whereColumn('kategori_id', 'kategoris.id')
        ->latest()
        ->limit(1),
    ])->get();

    return view('landing.home', compact('produks', 'kategoris'));
});

Route::get('/katalog', function () {
    $produks = Produk::with('kategori');

    if (request('kategori')) {
        $produks->where('kategori_id', request('kategori'));
    }

    if (request('sort') === 'price_low') {
        $produks->orderBy('harga', 'asc');
    } elseif (request('sort') === 'price_high') {
        $produks->orderBy('harga', 'desc');
    } else {
        $produks->latest();
    }

    $produks = $produks->paginate(12)->withQueryString();
    $kategoris = Kategori::all();

    return view('landing.produk', compact('produks', 'kategoris'));
})->name('landing.produk');

Route::middleware(IsAdmin::class)->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('produk', ProdukController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('pengguna', UserController::class);
});
