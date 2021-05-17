<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductHasTradeInfo
 */
class TempProductHasTradeInfo extends Model
{
    protected $table = 'temp_product_has_trade_info';

    public $timestamps = false;

    protected $fillable = [
        'moq',
        'price',
        'product_id'
    ];

    protected $guarded = [];

        
}