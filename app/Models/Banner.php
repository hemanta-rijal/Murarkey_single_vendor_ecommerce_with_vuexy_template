<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Class Banner
 */
class Banner extends Model
{
    protected $table = 'banners';

    public $timestamps = false;

    protected $fillable = [
        'slug',
        'name',
        'weight',
        'image',
        'link'
    ];

    protected $guarded = [];

    public static function findBySlug($slug)
    {
        if (!Cache::has('banner.' . $slug)) {
            $banner = self::whereSlug($slug)->orderBy('weight', 'DESC')->first();
            Cache::forever('banner.' . $slug, $banner);

            return $banner;
        } else {
            return Cache::get('banner.' . $slug);
        }
    }
    public static function findAllBySlug($slug)
    {
        if (!Cache::has('banner.' . $slug)) {
            $banner = self::whereSlug($slug)->orderBy('weight', 'DESC')->get();
            Cache::forever('banner.' . $slug, $banner);

            return $banner;
        } else {
            return Cache::get('banner.' . $slug);
        }
    }


    public function getImageUrlAttribute()
    {
        return map_storage_path_to_link($this->attributes['image']);
    }


}