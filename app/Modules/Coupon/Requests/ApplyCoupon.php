<?php


namespace App\Modules\Coupon\Requests;
use App\Http\Requests\BaseRequest;

class ApplyCoupon extends BaseRequest
{

    public function rules()
    {
        return [
          'coupon'=>'required|max:20'
        ];
    }
}