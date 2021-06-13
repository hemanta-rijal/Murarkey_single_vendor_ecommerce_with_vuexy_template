<?php

namespace App\Models;

use App\Models\CouponAppliedProducts;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['coupon', 'start_time', 'end_time', 'discount_type', 'discount', 'status'];

    protected $dates = [
        'start_time',
        'end_time',
    ];

    public function items()
    {
        return $this->hasMany(CouponAppliedProducts::class, 'coupon_id', 'id');
    }
}