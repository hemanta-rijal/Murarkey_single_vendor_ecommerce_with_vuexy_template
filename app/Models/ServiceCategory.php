<?php

namespace App\Models;

use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class ServiceCategory extends Model
{
    use NodeTrait, SearchableTrait;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'parent_id',
        'featured',
        'slug',
        'icon_image',
        'banner_image',
        'description',
        'service_count',
    ];
}
