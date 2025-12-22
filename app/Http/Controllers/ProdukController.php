<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->input('search');

        $query = Produk::with('kategori');

        $query->when($search, function ($q, $searchTerm) {
            $q->where('nama', 'like', "%{$searchTerm}%")
                ->orWhere('deskripsi', 'like', "%{$searchTerm}%");
        });

        $produk = $query->latest()->paginate(10)->withQueryString();
        $kategori = Kategori::all();

        return view('admin.produk.index', compact('produk', 'kategori'));
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
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'ukuran' => 'required',
            'warna' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = $request->file('gambar');
        $path = $foto->store('produk', 'public');

        Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'ukuran' => $request->ukuran,
            'warna' => $request->warna,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'gambar' => $path,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
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
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'ukuran' => 'required',
            'warna' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $dataToUpdate = [
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'ukuran' => $request->ukuran,
            'warna' => $request->warna,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
        ];

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $gambar = $request->file('gambar');
            $path = $gambar->store('produk', 'public');
            $dataToUpdate['gambar'] = $path;
        }

        $produk->update($dataToUpdate);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        if ($produk->transaksiDetails()->exists()) {
            return redirect()->route('produk.index')
                ->with('error', 'Produk tidak dapat dihapus karena sudah pernah dibeli. Silakan nonaktifkan (set stok 0) jika ingin menyembunyikannya.');
        }
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
