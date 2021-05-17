<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductHasTradeInfo
 */
class ProductHasTradeInfo extends Model
{
    protected $table = 'product_has_trade_info';

    public $timestamps = false;

    protected $fillable = [
        'moq',
        'price',
        'product_id'
    ];

    protected $guarded = [];

        
}