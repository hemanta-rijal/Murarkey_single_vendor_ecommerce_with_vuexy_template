<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FeaturedCategoriesHasProduct
 */
class FeaturedCategoriesHasProduct extends Model
{
    protected $table = 'featured_categories_has_products';

    public $timestamps = true;

    protected $fillable = [
        'weight',
        'featured_category_id',
        'product_id'
    ];

    protected $guarded = [];


    public function featured_category()
    {
        return $this->belongsTo(FeaturedCategory::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}