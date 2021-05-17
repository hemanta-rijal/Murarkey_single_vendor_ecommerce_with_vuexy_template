<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductHasAttribute
 */
class TempProductHasAttribute extends Model
{
    protected $table = 'temp_product_has_attributes';

    public $timestamps = false;

    protected $fillable = [
        'key',
        'value',
        'product_id'
    ];

    protected $guarded = [];

        
}