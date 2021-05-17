<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SocialAccount
 */
class SocialAccount extends Model
{
    public $timestamps = false;
    protected $table = 'social_accounts';
    protected $fillable = [
        'provider',
        'provider_user_id',
        'response_data',
        'user_id'
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}