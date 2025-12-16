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
        'payment_method',
        'snap_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
