<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'duration',
        'icon_image',
        'featured_image',
        'short_description',
        'description',
        'service_charge',
    ];
}
