<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinMurarkey extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'viber_number',
        'preferred_work',
        'preferred_location',
        'about',
    ];
}
