<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FeaturedCompaniesHasProduct
 */
class FeaturedCompaniesHasProduct extends Model
{
    protected $table = 'featured_companies_has_products';

    public $timestamps = true;

    protected $fillable = [
        'weight',
        'product_id',
        'featured_company_id'
    ];

    protected $guarded = [];

    public function featured_company()
    {
        return $this->belongsTo(FeaturedCompany::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

        
}