<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SliderImage
 */
class SliderImage extends Model
{
    public $timestamps = false;
    protected $table = 'slider_images';
    protected $fillable = [
        'image',
        'caption',
        'weight',
        'link'
    ];

    protected $appends = [
        'image_url'
    ];

    protected $guarded = [];


    public function getImageUrlAttribute()
    {
        if (isset($this->attributes['image']) && $this->attributes['image'])
            return map_storage_path_to_link($this->attributes['image']);
    }


}