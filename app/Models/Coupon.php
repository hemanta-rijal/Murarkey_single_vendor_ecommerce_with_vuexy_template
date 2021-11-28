<?php

namespace App\Models;

use App\Models\CouponAppliedProducts;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['coupon', 'coupon_for', 'start_time', 'end_time', 'discount_type', 'discount', 'status'];
    protected $appends = ['isActive','couponDetail'];
    protected $dates = [
        'start_time',
        'end_time',
    ];

    public function items()
    {
        return $this->hasMany(CouponAppliedProducts::class, 'coupon_id', 'id');
    }
    public function getIsActiveAttribute(){
        $date = date('Y-m-d H:i');
        if(strtotime($date)>strtotime($this->start_time) && strtotime($date)<strtotime($this->end_time)){
            return true;
        }
        return false;
    }
    public function getCouponDetailAttribute(){
        if($this->getIsActiveAttribute()){
           return json_decode($this->coupon_for,true);
        }
    }
}
