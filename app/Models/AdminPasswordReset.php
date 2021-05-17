<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminPasswordReset
 */
class AdminPasswordReset extends Model
{
    protected $table = 'admin_password_resets';

    public $timestamps = true;

    protected $fillable = [
        'email',
        'token'
    ];

    protected $guarded = [];

        
}