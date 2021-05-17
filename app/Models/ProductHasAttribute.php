<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductHasAttribute
 */
class ProductHasAttribute extends Model
{
    protected $table = 'product_has_attributes';

    public $timestamps = false;

    protected $fillable = [
        'key',
        'value',
        'product_id'
    ];

    protected $guarded = [];

        
}