<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Fathur Rahman',
            'email' => 'patur@gmail.com',
            'password' => bcrypt('123123123'),
            'role' => 'admin',
        ]);

        $kategori1 = \App\Models\Kategori::create([
            'kategori' => 'Men Collection',
            'deskripsi' => 'Pakaian kasual dan formal untuk pria modern.',
        ]);

        $kategori2 = \App\Models\Kategori::create([
            'kategori' => 'Women Collection',
            'deskripsi' => 'Gaya elegan dan nyaman untuk wanita aktif.',
        ]);

        $kategori3 = \App\Models\Kategori::create([
            'kategori' => 'Accessories',
            'deskripsi' => 'Pelengkap gaya sehari-hari Anda.',
        ]);

        \App\Models\Produk::create([
            'nama' => 'Classic Linen Shirt',
            'harga' => 250000,
            'stok' => 50,
            'ukuran' => 'S, M, L, XL',
            'warna' => 'White, Beige, Blue',
            'deskripsi' => 'Kemeja linen berkualitas tinggi yang nyaman dipakai seharian.',
            'gambar' => null, // Placeholder will be used
            'kategori_id' => $kategori1->id,
        ]);

        \App\Models\Produk::create([
            'nama' => 'Cotton Chino Pants',
            'harga' => 300000,
            'stok' => 30,
            'ukuran' => '28, 30, 32, 34',
            'warna' => 'Khaki, Navy, Black',
            'deskripsi' => 'Celana chino katun dengan potongan slim fit.',
            'gambar' => null,
            'kategori_id' => $kategori1->id,
        ]);

        \App\Models\Produk::create([
            'nama' => 'Summer Floral Dress',
            'harga' => 450000,
            'stok' => 20,
            'ukuran' => 'S, M, L',
            'warna' => 'Red, Yellow, Blue',
            'deskripsi' => 'Dress motif bunga yang cocok untuk musim panas.',
            'gambar' => null,
            'kategori_id' => $kategori2->id,
        ]);

        \App\Models\Produk::create([
            'nama' => 'Leather Wallet',
            'harga' => 150000,
            'stok' => 100,
            'ukuran' => 'One Size',
            'warna' => 'Brown, Black',
            'deskripsi' => 'Dompet kulit asli dengan desain minimalis.',
            'gambar' => null,
            'kategori_id' => $kategori3->id,
        ]);
    }
}
