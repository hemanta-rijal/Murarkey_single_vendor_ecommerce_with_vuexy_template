<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashSaleItem extends Model
{
    protected $fillable = [
        'weight',
        'discount',
        'flash_sale_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function flash_sale() {
        return $this->belongsTo(FlashSale::class, 'id', 'flash_sale_id');
    }
}
