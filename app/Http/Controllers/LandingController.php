<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display the landing page (home).
     */
    public function index()
    {
        $produks = Produk::with('kategori')->latest()->take(8)->get();
        $kategoris = Kategori::addSelect(['gambar_terbaru' => Produk::select('gambar')
            ->whereColumn('kategori_id', 'kategoris.id')
            ->latest()
            ->limit(1),
        ])->get();

        return view('landing.home', compact('produks', 'kategoris'));
    }

    /**
     * Display the product catalog page (katalog).
     */
    public function produk(Request $request)
    {
        $produks = Produk::with('kategori');

        if ($request->kategori) {
            $produks->where('kategori_id', $request->kategori);
        }

        if ($request->sort === 'price_low') {
            $produks->orderBy('harga', 'asc');
        } elseif ($request->sort === 'price_high') {
            $produks->orderBy('harga', 'desc');
        } else {
            $produks->latest();
        }

        $produks = $produks->paginate(12)->withQueryString();
        $kategoris = Kategori::all();

        return view('landing.produk', compact('produks', 'kategoris'));
    }
    /**
     * Display the specified product detail.
     */
    public function show(Produk $produk)
    {
        $produk->load('kategori');
        
        $relatedProducts = Produk::where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->take(4)
            ->get();

        return view('landing.detail-produk', compact('produk', 'relatedProducts'));
    }
}
