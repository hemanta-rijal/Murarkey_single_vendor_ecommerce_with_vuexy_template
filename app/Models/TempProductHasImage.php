<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductHasImage
 */
class TempProductHasImage extends Model
{
    protected $table = 'temp_product_has_images';

    public $timestamps = false;

    protected $fillable = [
        'image',
        'caption',
        'product_id'
    ];

    protected $guarded = [];

        
}