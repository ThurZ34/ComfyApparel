<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    protected $table = 'topups';

    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'status',
        'approved_at',
        'payment_method',
        'snap_token',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'amount' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
