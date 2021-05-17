<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductHasImage
 */
class ProductHasImage extends Model
{
    public $timestamps = false;
    protected $table = 'product_has_images';
    protected $fillable = [
        'image',
        'caption',
        'product_id'
    ];

    protected $guarded = [];

    protected $appends = [
        'image_url',
        'image600_x600_url',
        'image200_x200_url'
    ];


    public function getImageUrlAttribute()
    {
        if (isset($this->attributes['image']) && $this->attributes['image'])
            return map_storage_path_to_link($this->attributes['image']);
    }

    public function getImage600X600UrlAttribute()
    {
        if (isset($this->attributes['image']))
            return resize_image_url($this->attributes['image'], '600X600');

    }


    public function getImage200X200UrlAttribute()
    {
        if (isset($this->attributes['image']))
            return resize_image_url($this->attributes['image'], '200X200');

    }
}