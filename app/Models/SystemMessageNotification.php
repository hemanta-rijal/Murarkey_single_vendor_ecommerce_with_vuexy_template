<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemMessageNotification extends Model
{
    protected $fillable = [
        'user_id',
        'sender_id',
        'status',
        'auto_change_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
