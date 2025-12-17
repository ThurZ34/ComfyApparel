<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'subtotal',
        'ongkir',
        'total_harga',
        'alamat_pengiriman',
        'nama_penerima',
        'no_telp_penerima',
        'status',
        'catatan',
        'admin_notes',
        'paid_at',
        'shipped_at',
        'completed_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Relasi ke User (Pembeli)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke TransaksiDetail (Item yang dibeli)
     * SATU transaksi BANYAK detail
     */
    public function details(): HasMany
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    /**
     * Boot method untuk generate kode transaksi otomatis
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaksi) {
            if (empty($transaksi->kode_transaksi)) {
                $transaksi->kode_transaksi = 'TRX-'.now()->format('Ymd').'-'.str_pad(static::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
