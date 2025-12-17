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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique(); // Format: TRX-20231216-0001

            // Relasi ke user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Informasi harga
            $table->decimal('subtotal', 15, 2); // Total harga produk sebelum ongkir
            $table->decimal('ongkir', 15, 2)->default(0); // Ongkos kirim
            $table->decimal('total_harga', 15, 2); // Subtotal + Ongkir

            // Informasi pengiriman
            $table->text('alamat_pengiriman'); // Alamat lengkap pengiriman
            $table->string('nama_penerima'); // Nama penerima
            $table->string('no_telp_penerima'); // Nomor telepon penerima

            // Status transaksi
            $table->enum('status', ['pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled'])->default('pending');

            // Catatan
            $table->text('catatan')->nullable(); // Catatan dari pembeli
            $table->text('admin_notes')->nullable(); // Catatan dari admin

            // Timestamps
            $table->timestamp('paid_at')->nullable(); // Kapan dibayar
            $table->timestamp('shipped_at')->nullable(); // Kapan dikirim
            $table->timestamp('completed_at')->nullable(); // Kapan selesai
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
