<?php

namespace App\Models;

use App\Models\ServiceHasServiceLabel;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'duration',
        'icon_image',
        'category_id',
        'featured_image',
        'short_description',
        'description',
        'service_charge',
    ];

    public function labels()
    {
        return $this->hasMany(ServiceHasServiceLabel::class);
    }

}
