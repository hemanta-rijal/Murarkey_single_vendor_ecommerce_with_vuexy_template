<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Class Meta
 */
class Meta extends Model
{
    public $timestamps = false;
    
    public static function findByKeyOrFail($key)
    {

        $meta = self::findByKey($key);
        if (!$meta) {
            // throw new ModelNotFoundException();
            return null;
        }
        return $meta;
    }

    public static function findByKey($key)
    {
        if (!Cache::has('meta.' . $key)) {
            $meta = self::where('key', $key)->first();
            Cache::forever('meta.' . $key, $meta);
            return $meta;
        } else {
            return Cache::get('meta.' . $key);
        }
    }

}
