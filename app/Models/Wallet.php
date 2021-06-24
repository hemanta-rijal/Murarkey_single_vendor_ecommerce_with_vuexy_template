<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_type',
        'payment_method',
        'description',
        'amount',
        'status',
        'total_amount',
    ];
}
