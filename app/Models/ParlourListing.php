<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParlourListing extends Model
{
    protected $fillable=[
        'name',
        'slug',
        'address',
        'about',
        'category_id',
        'feature_image',
        'featured',
        'status',
        'phone',
        'mobile',
        'email',
        'website',
        'facebook',
        'twitter',
        'instagram',
        'youtube'
    ];
}
