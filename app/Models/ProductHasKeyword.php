<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductHasKeyword
 */
class ProductHasKeyword extends Model
{
    protected $table = 'product_has_keywords';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'products_id'
    ];

    protected $guarded = [];

        
}