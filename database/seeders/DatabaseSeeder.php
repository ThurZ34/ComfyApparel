<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
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
        // ========================================
        // USERS
        // ========================================

        // Admin User
        User::factory()->create([
            'name' => 'Fathur Rahman',
            'email' => 'patur@gmail.com',
            'password' => bcrypt('123123123'),
            'role' => 'admin',
            'balance' => 500000,
        ]);

        // Regular Users
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'balance' => 250000,
        ]);

        User::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'balance' => 100000,
        ]);

        // ========================================
        // CATEGORIES
        // ========================================

        $kategoris = [
            [
                'kategori' => 'Men Collection',
                'deskripsi' => 'Koleksi pakaian kasual dan formal untuk pria modern yang mengutamakan kenyamanan dan gaya.',
            ],
            [
                'kategori' => 'Women Collection',
                'deskripsi' => 'Gaya elegan dan nyaman untuk wanita aktif dengan pilihan outfit dari kasual hingga formal.',
            ],
            [
                'kategori' => 'Accessories',
                'deskripsi' => 'Pelengkap gaya sehari-hari Anda dengan berbagai aksesoris berkualitas.',
            ],
            [
                'kategori' => 'Footwear',
                'deskripsi' => 'Koleksi alas kaki trendy dan nyaman untuk berbagai kesempatan.',
            ],
            [
                'kategori' => 'Outerwear',
                'deskripsi' => 'Jaket, hoodie, dan outer lainnya untuk melengkapi penampilan Anda.',
            ],
            [
                'kategori' => 'Kids Collection',
                'deskripsi' => 'Pakaian lucu dan nyaman untuk si kecil dengan bahan yang aman.',
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }

        // ========================================
        // PRODUCTS
        // ========================================

        $products = [
            // Men Collection (kategori_id: 1)
            [
                'nama' => 'Classic Linen Shirt',
                'harga' => 249000,
                'stok' => 50,
                'ukuran' => 'S, M, L, XL',
                'warna' => 'White, Beige, Blue',
                'deskripsi' => 'Kemeja linen berkualitas tinggi yang nyaman dipakai seharian. Cocok untuk acara kasual maupun semi-formal.',
                'kategori_id' => 1,
                'gambar' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=600',
            ],
            [
                'nama' => 'Cotton Chino Pants',
                'harga' => 299000,
                'stok' => 35,
                'ukuran' => '28, 30, 32, 34',
                'warna' => 'Khaki, Navy, Black',
                'deskripsi' => 'Celana chino katun dengan potongan slim fit yang stylish dan nyaman.',
                'kategori_id' => 1,
                'gambar' => 'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?w=600',
            ],
            [
                'nama' => 'Casual Polo Shirt',
                'harga' => 189000,
                'stok' => 80,
                'ukuran' => 'S, M, L, XL, XXL',
                'warna' => 'Navy, White, Red, Black',
                'deskripsi' => 'Polo shirt klasik dengan bahan katun premium yang breathable.',
                'kategori_id' => 1,
                'gambar' => 'https://images.unsplash.com/photo-1625910513413-5fc420e751be?w=600',
            ],
            [
                'nama' => 'Slim Fit Jeans',
                'harga' => 349000,
                'stok' => 45,
                'ukuran' => '28, 30, 32, 34, 36',
                'warna' => 'Blue Wash, Black, Dark Blue',
                'deskripsi' => 'Jeans dengan potongan slim fit dari denim berkualitas dengan sedikit stretch untuk kenyamanan.',
                'kategori_id' => 1,
                'gambar' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=600',
            ],
            [
                'nama' => 'Oxford Button Down',
                'harga' => 279000,
                'stok' => 25,
                'ukuran' => 'S, M, L, XL',
                'warna' => 'Light Blue, White, Pink',
                'deskripsi' => 'Kemeja oxford dengan kerah button-down, sempurna untuk tampilan smart casual.',
                'kategori_id' => 1,
                'gambar' => 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=600',
            ],
            [
                'nama' => 'Basic T-Shirt Pack',
                'harga' => 199000,
                'stok' => 100,
                'ukuran' => 'S, M, L, XL',
                'warna' => 'Mixed Colors',
                'deskripsi' => 'Paket 3 kaos basic dari katun combed 30s yang lembut dan nyaman.',
                'kategori_id' => 1,
                'gambar' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=600',
            ],

            // Women Collection (kategori_id: 2)
            [
                'nama' => 'Summer Floral Dress',
                'harga' => 399000,
                'stok' => 30,
                'ukuran' => 'S, M, L',
                'warna' => 'Red Floral, Yellow Floral, Blue Floral',
                'deskripsi' => 'Dress motif bunga yang cocok untuk musim panas dengan bahan yang ringan dan nyaman.',
                'kategori_id' => 2,
                'gambar' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=600',
            ],
            [
                'nama' => 'High Waist Culottes',
                'harga' => 259000,
                'stok' => 40,
                'ukuran' => 'S, M, L, XL',
                'warna' => 'Black, Cream, Olive',
                'deskripsi' => 'Celana kulot high waist yang stylish dan nyaman untuk daily wear.',
                'kategori_id' => 2,
                'gambar' => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=600',
            ],
            [
                'nama' => 'Oversized Knit Sweater',
                'harga' => 329000,
                'stok' => 25,
                'ukuran' => 'Free Size',
                'warna' => 'Cream, Brown, Grey',
                'deskripsi' => 'Sweater rajut oversized yang cozy dan fashionable untuk cuaca dingin.',
                'kategori_id' => 2,
                'gambar' => 'https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=600',
            ],
            [
                'nama' => 'Midi A-Line Skirt',
                'harga' => 229000,
                'stok' => 35,
                'ukuran' => 'S, M, L',
                'warna' => 'Black, Navy, Beige',
                'deskripsi' => 'Rok midi dengan potongan A-line yang feminin dan mudah dipadukan.',
                'kategori_id' => 2,
                'gambar' => 'https://images.unsplash.com/photo-1583496661160-fb5886a0uj07?w=600',
            ],
            [
                'nama' => 'Silk Blouse',
                'harga' => 449000,
                'stok' => 20,
                'ukuran' => 'S, M, L',
                'warna' => 'White, Champagne, Black',
                'deskripsi' => 'Blus sutra premium dengan draping yang elegan untuk acara formal.',
                'kategori_id' => 2,
                'gambar' => 'https://images.unsplash.com/photo-1551489186-cf8726f514f8?w=600',
            ],
            [
                'nama' => 'Casual Jumpsuit',
                'harga' => 379000,
                'stok' => 15,
                'ukuran' => 'S, M, L',
                'warna' => 'Olive, Black, Terracotta',
                'deskripsi' => 'Jumpsuit kasual yang praktis dan stylish untuk berbagai kesempatan.',
                'kategori_id' => 2,
                'gambar' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=600',
            ],

            // Accessories (kategori_id: 3)
            [
                'nama' => 'Leather Wallet',
                'harga' => 179000,
                'stok' => 75,
                'ukuran' => 'One Size',
                'warna' => 'Brown, Black, Tan',
                'deskripsi' => 'Dompet kulit asli dengan desain minimalis dan slot kartu yang praktis.',
                'kategori_id' => 3,
                'gambar' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=600',
            ],
            [
                'nama' => 'Canvas Tote Bag',
                'harga' => 149000,
                'stok' => 60,
                'ukuran' => 'One Size',
                'warna' => 'Natural, Black, Navy',
                'deskripsi' => 'Tote bag kanvas yang kuat dan ramah lingkungan untuk daily use.',
                'kategori_id' => 3,
                'gambar' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=600',
            ],
            [
                'nama' => 'Classic Watch',
                'harga' => 599000,
                'stok' => 15,
                'ukuran' => 'One Size',
                'warna' => 'Silver, Gold, Rose Gold',
                'deskripsi' => 'Jam tangan klasik dengan desain minimalis dan movement Jepang.',
                'kategori_id' => 3,
                'gambar' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?w=600',
            ],
            [
                'nama' => 'Leather Belt',
                'harga' => 129000,
                'stok' => 50,
                'ukuran' => 'S, M, L, XL',
                'warna' => 'Black, Brown',
                'deskripsi' => 'Ikat pinggang kulit genuine dengan buckle stainless steel.',
                'kategori_id' => 3,
                'gambar' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=600',
            ],
            [
                'nama' => 'Sunglasses Collection',
                'harga' => 249000,
                'stok' => 40,
                'ukuran' => 'One Size',
                'warna' => 'Black, Tortoise, Clear',
                'deskripsi' => 'Kacamata hitam dengan lensa UV protection dan frame acetate premium.',
                'kategori_id' => 3,
                'gambar' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=600',
            ],

            // Footwear (kategori_id: 4)
            [
                'nama' => 'Canvas Sneakers',
                'harga' => 349000,
                'stok' => 45,
                'ukuran' => '38, 39, 40, 41, 42, 43, 44',
                'warna' => 'White, Black, Navy',
                'deskripsi' => 'Sneakers kanvas klasik yang versatile untuk daily outfit.',
                'kategori_id' => 4,
                'gambar' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?w=600',
            ],
            [
                'nama' => 'Leather Loafers',
                'harga' => 499000,
                'stok' => 25,
                'ukuran' => '39, 40, 41, 42, 43',
                'warna' => 'Brown, Black, Burgundy',
                'deskripsi' => 'Loafers kulit premium dengan sol yang nyaman untuk penggunaan seharian.',
                'kategori_id' => 4,
                'gambar' => 'https://images.unsplash.com/photo-1614252369475-531eba835eb1?w=600',
            ],
            [
                'nama' => 'Comfort Sandals',
                'harga' => 199000,
                'stok' => 60,
                'ukuran' => '36, 37, 38, 39, 40, 41, 42',
                'warna' => 'Black, Brown, Beige',
                'deskripsi' => 'Sandal dengan footbed ergonomis untuk kenyamanan maksimal.',
                'kategori_id' => 4,
                'gambar' => 'https://images.unsplash.com/photo-1603487742131-4160ec999306?w=600',
            ],
            [
                'nama' => 'Running Shoes',
                'harga' => 599000,
                'stok' => 30,
                'ukuran' => '38, 39, 40, 41, 42, 43, 44',
                'warna' => 'Black/White, Blue/Grey, All Black',
                'deskripsi' => 'Sepatu lari dengan teknologi cushioning untuk performa optimal.',
                'kategori_id' => 4,
                'gambar' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',
            ],

            // Outerwear (kategori_id: 5)
            [
                'nama' => 'Denim Jacket',
                'harga' => 449000,
                'stok' => 20,
                'ukuran' => 'S, M, L, XL',
                'warna' => 'Light Blue, Dark Blue, Black',
                'deskripsi' => 'Jaket denim klasik yang timeless dan cocok untuk layering.',
                'kategori_id' => 5,
                'gambar' => 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?w=600',
            ],
            [
                'nama' => 'Bomber Jacket',
                'harga' => 399000,
                'stok' => 25,
                'ukuran' => 'S, M, L, XL',
                'warna' => 'Black, Olive, Navy',
                'deskripsi' => 'Bomber jacket dengan bahan water-resistant dan lining yang nyaman.',
                'kategori_id' => 5,
                'gambar' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=600',
            ],
            [
                'nama' => 'Cotton Hoodie',
                'harga' => 289000,
                'stok' => 50,
                'ukuran' => 'S, M, L, XL, XXL',
                'warna' => 'Black, Grey, Navy, White',
                'deskripsi' => 'Hoodie katun fleece yang hangat dan nyaman untuk casual wear.',
                'kategori_id' => 5,
                'gambar' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=600',
            ],
            [
                'nama' => 'Trench Coat',
                'harga' => 699000,
                'stok' => 10,
                'ukuran' => 'S, M, L',
                'warna' => 'Beige, Black, Navy',
                'deskripsi' => 'Trench coat klasik yang elegan untuk tampilan sophisticated.',
                'kategori_id' => 5,
                'gambar' => 'https://images.unsplash.com/photo-1544022613-e87ca75a784a?w=600',
            ],
            [
                'nama' => 'Puffer Vest',
                'harga' => 349000,
                'stok' => 30,
                'ukuran' => 'S, M, L, XL',
                'warna' => 'Black, Olive, Grey',
                'deskripsi' => 'Vest puffer yang ringan namun hangat, sempurna untuk layering.',
                'kategori_id' => 5,
                'gambar' => 'https://images.unsplash.com/photo-1548126032-079a0fb0099d?w=600',
            ],

            // Kids Collection (kategori_id: 6)
            [
                'nama' => 'Kids Cotton T-Shirt',
                'harga' => 99000,
                'stok' => 80,
                'ukuran' => '2-3Y, 4-5Y, 6-7Y, 8-9Y',
                'warna' => 'Mixed Colors',
                'deskripsi' => 'Kaos anak dari katun organik yang lembut dan aman untuk kulit sensitif.',
                'kategori_id' => 6,
                'gambar' => 'https://images.unsplash.com/photo-1519238263530-99bdd11df2ea?w=600',
            ],
            [
                'nama' => 'Kids Denim Pants',
                'harga' => 179000,
                'stok' => 45,
                'ukuran' => '2-3Y, 4-5Y, 6-7Y, 8-9Y',
                'warna' => 'Blue, Light Blue',
                'deskripsi' => 'Celana jeans anak dengan stretch untuk kenyamanan bermain.',
                'kategori_id' => 6,
                'gambar' => 'https://images.unsplash.com/photo-1503944583220-79d8926ad5e2?w=600',
            ],
            [
                'nama' => 'Kids Dress Set',
                'harga' => 199000,
                'stok' => 35,
                'ukuran' => '2-3Y, 4-5Y, 6-7Y',
                'warna' => 'Pink, Purple, Blue',
                'deskripsi' => 'Set dress anak dengan motif lucu dan bahan yang nyaman.',
                'kategori_id' => 6,
                'gambar' => 'https://images.unsplash.com/photo-1518831959646-742c3a14ebf7?w=600',
            ],
            [
                'nama' => 'Kids Hoodie',
                'harga' => 159000,
                'stok' => 40,
                'ukuran' => '2-3Y, 4-5Y, 6-7Y, 8-9Y',
                'warna' => 'Grey, Navy, Red',
                'deskripsi' => 'Hoodie anak yang hangat dan playful untuk aktivitas outdoor.',
                'kategori_id' => 6,
                'gambar' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=600',
            ],

            // More products for variety
            [
                'nama' => 'Linen Blazer',
                'harga' => 549000,
                'stok' => 15,
                'ukuran' => 'S, M, L, XL',
                'warna' => 'Beige, Navy, Grey',
                'deskripsi' => 'Blazer linen yang breathable dan stylish untuk smart casual look.',
                'kategori_id' => 1,
                'gambar' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=600',
            ],
            [
                'nama' => 'Wrap Dress',
                'harga' => 429000,
                'stok' => 18,
                'ukuran' => 'S, M, L',
                'warna' => 'Black, Wine, Forest Green',
                'deskripsi' => 'Wrap dress yang flattering dan versatile untuk berbagai kesempatan.',
                'kategori_id' => 2,
                'gambar' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=600',
            ],
            [
                'nama' => 'Crossbody Bag',
                'harga' => 279000,
                'stok' => 35,
                'ukuran' => 'One Size',
                'warna' => 'Black, Tan, Burgundy',
                'deskripsi' => 'Tas selempang dari kulit sintetis premium yang praktis dan stylish.',
                'kategori_id' => 3,
                'gambar' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=600',
            ],
            [
                'nama' => 'Chelsea Boots',
                'harga' => 649000,
                'stok' => 0,
                'ukuran' => '39, 40, 41, 42, 43',
                'warna' => 'Black, Brown',
                'deskripsi' => 'Chelsea boots kulit dengan sol karet yang nyaman dan tahan lama.',
                'kategori_id' => 4,
                'gambar' => 'https://images.unsplash.com/photo-1638247025967-b4e38f787b76?w=600',
            ],
            [
                'nama' => 'Windbreaker Jacket',
                'harga' => 329000,
                'stok' => 28,
                'ukuran' => 'S, M, L, XL',
                'warna' => 'Black, Navy, Red',
                'deskripsi' => 'Jaket windbreaker yang ringan dan packable untuk outdoor activity.',
                'kategori_id' => 5,
                'gambar' => 'https://images.unsplash.com/photo-1545594861-3bef43ff2fc8?w=600',
            ],
        ];

        foreach ($products as $product) {
            Produk::create($product);
        }
    }
}
