<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ThemeSetting extends Model
{
    protected $fillable = ['key', 'value', 'description'];
    public $timestamps = false;
    public static function findByKeyOrFail($key)
    {

        $theme = self::findByKey($key);
        if (!$theme) {
            // throw new ModelNotFoundException();
            return null;
        }

        return $theme;
    }

    public static function findByKey($key)
    {
        if (!Cache::has('theme.' . $key)) {
            $theme = self::where('key', $key)->first();
            Cache::forever('theme.' . $key, $theme);
            return $theme;
        } else {
            return Cache::get('theme.' . $key);
        }
    }
}
