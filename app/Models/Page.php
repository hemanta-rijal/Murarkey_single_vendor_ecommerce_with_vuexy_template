<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Page extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'content',
        'template',
        'published',
        'is_there_php',
    ];

    public $timestamps = false;

    public static function findBySlug($slug)
    {
        if (!Cache::has('page.' . $slug)) {
            $page = self::whereSlug($slug)->firstOrFail();
//            Cache::forever('page.' . $slug, $page);
            return $page;
        } else {
            return Cache::get('page.' . $slug);
        }
    }
}
