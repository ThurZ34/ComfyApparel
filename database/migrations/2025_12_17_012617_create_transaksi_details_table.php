<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->id();

            // Relasi ke transaksi master
            $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade');

            // Relasi ke produk
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');

            // Detail item
            $table->string('nama_produk'); // Snapshot nama produk saat transaksi
            $table->decimal('harga_satuan', 15, 2); // Snapshot harga saat transaksi
            $table->integer('quantity'); // Jumlah yang dibeli
            $table->decimal('subtotal', 15, 2); // harga_satuan * quantity

            // Catatan per item (opsional)
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};
