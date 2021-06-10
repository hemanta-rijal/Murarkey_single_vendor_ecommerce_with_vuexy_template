<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponAppliedProducts extends Model
{

    protected $fillable = [
        'coupon_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function flash_sale()
    {
        return $this->belongsTo(Coupon::class, 'id', 'coupon_id');
    }
}
