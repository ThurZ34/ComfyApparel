<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiDetail extends Model
{
    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'nama_produk',
        'harga_satuan',
        'quantity',
        'subtotal',
        'catatan',
    ];

    /**
     * Relasi ke Transaksi (Master)
     */
    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class);
    }

    /**
     * Relasi ke Produk
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}
