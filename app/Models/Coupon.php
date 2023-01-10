<?php

namespace App\Models;

use App\Models\CouponAppliedProducts;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['coupon', 'coupon_for', 'start_time', 'end_time', 'discount_type', 'discount', 'status'];
    protected $appends = ['isActive','couponDetail','couponAppliedList'];
    protected $dates = [
        'start_time',
        'end_time',
    ];

    public function items()
    {
        return $this->hasMany(CouponAppliedProducts::class, 'coupon_id', 'id');
    }

    /**
     * this function check the start and end date for coupon and return the weather it is applicable for not
     * @return bool
     */
    public function getIsActiveAttribute(){
        $date = date('Y-m-d');
        $date = date('Y-m-d', strtotime($date));
        $start_date = date('Y-m-d', strtotime($this->start_time));
        $end_date = date('Y-m-d', strtotime($this->end_time));
        if(($date >= $start_date) && ($date <= $end_date)){
            return true;
        }
        return false;
    }
    public function getCouponDetailAttribute(){
        if($this->getIsActiveAttribute()){
           return json_decode($this->coupon_for,true);
        }
    }

    /**
     * function that generate the formatted text for coupon applied list for view
     * @return string|void
     */
    public function getCouponAppliedListAttribute(){
        if(isset($this->coupon_for)){
            $str="<ul>";
            $couponJson = json_decode($this->coupon_for);
            foreach ($couponJson as $key=>$value){
                if ($key=='all_product' || $key=='all_services') $str.="<li>".$key."</li>";
                if($key=='brands'){
                   $brand =  Brand::find($value);
                   if($brand!=null) $str.="<li>".$brand->name."</li>";
                }
            }
            $str.="</ul>";
            return $str;
        }
    }
}
