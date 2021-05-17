<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FeaturedCompany
 */
class FeaturedCompany extends Model
{
    protected $table = 'featured_companies';

    public $timestamps = true;

    protected $fillable = [
        'weight',
        'name',
        'company_id'
    ];

    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function products()
    {
        return $this->hasMany(FeaturedCompaniesHasProduct::class);
    }

}