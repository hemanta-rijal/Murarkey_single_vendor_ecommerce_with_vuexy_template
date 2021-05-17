<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductHasKeyword
 */
class TempProductHasKeyword extends Model
{
    protected $table = 'temp_product_has_keywords';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'products_id'
    ];

    protected $guarded = [];

        
}