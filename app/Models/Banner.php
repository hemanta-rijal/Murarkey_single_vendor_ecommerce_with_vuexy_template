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
        'position',
        'name',
        'weight',
        'image',
        'link',
    ];

    protected $guarded = [];

    public static function findByPosition($type)
    {
        if (!Cache::has('banner.' . $position)) {
            $banner = self::wherePosition($position)->orderBy('weight', 'DESC')->first();
            Cache::forever('banner.' . position, $banner);

            return $banner;
        } else {
            return Cache::get('banner.' . $position);
        }
    }
    public static function findAllByPosition($position)
    {
        if (!Cache::has('banner.' . $position)) {
            $banner = self::wherePosition($position)->orderBy('weight', 'DESC')->get();
            Cache::forever('banner.' . $position, $banner);

            return $banner;
        } else {
            return Cache::get('banner.' . $position);
        }
    }
    public function getImageUrlAttribute()
    {
        return map_storage_path_to_link($this->attributes['image']);
    }

}
