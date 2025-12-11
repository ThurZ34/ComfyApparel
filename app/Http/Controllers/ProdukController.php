<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = $request->file('gambar');
        $path = $foto->store('produk', 'public');

        $produk = Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        request()->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produk = Produk::findOrFail($produk->id);

        if ($request->hasFile('gambar')) {
        
            if($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $gambar = $request->file('gambar');
            $path = $gambar->store('produk', 'public');

            $produk->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'deskripsi' => $request->deskripsi,
                'gambar' => $path,
            ]);
        } else {
            $produk->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'deskripsi' => $request->deskripsi,
            ]);
        }
        
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
