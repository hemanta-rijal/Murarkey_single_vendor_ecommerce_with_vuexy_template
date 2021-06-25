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

    public function backupdata()
    {
        return [
            'user_id' => $this->user_id,
            'transaction_type' => $this->transaction_type,
            'payment_method' => $this->payment_method,
            'description' => $this->description,
            'amount' => $this->amount,
            'status' => $this->status,
            'total_amount' => $this->total_amount,

        ];
    }
}
