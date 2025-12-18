<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiLog extends Model
{
    protected $fillable = [
        'transaksi_id',
        'admin_id',
        'status_lama',
        'status_baru',
        'catatan',
    ];

    /**
     * Relasi ke Transaksi
     */
    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class);
    }

    /**
     * Relasi ke Admin (User yang melakukan perubahan)
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
