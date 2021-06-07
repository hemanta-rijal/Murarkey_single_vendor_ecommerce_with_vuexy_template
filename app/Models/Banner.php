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
        'type',
        'name',
        'weight',
        'image',
        'link',
    ];

    protected $guarded = [];

    public static function findByType($type)
    {
        if (!Cache::has('banner.' . $type)) {
            $banner = self::whereType(type)->orderBy('weight', 'DESC')->first();
            Cache::forever('banner.' . type, $banner);

            return $banner;
        } else {
            return Cache::get('banner.' . $type);
        }
    }
    public static function findAllBySlug($type)
    {
        if (!Cache::has('banner.' . $type)) {
            $banner = self::whereType($type)->orderBy('weight', 'DESC')->get();
            Cache::forever('banner.' . $type, $banner);

            return $banner;
        } else {
            return Cache::get('banner.' . $type);
        }
    }
    public function getImageUrlAttribute()
    {
        return map_storage_path_to_link($this->attributes['image']);
    }

}
