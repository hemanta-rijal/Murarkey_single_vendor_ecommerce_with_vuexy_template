<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FeaturedCategory
 */
class FeaturedCategory extends Model
{
    protected $table = 'featured_categories';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'weight',
        'category_id',
    ];

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        // return $this->hasMany(Product::class);
        return $this->hasMany(FeaturedCategoriesHasProduct::class, 'featured_category_id');
    }

    public function FeaturedCategoriesHasProduct()
    {
        return $this->hasMany(FeaturedCategoriesHasProduct::class);
    }

}
