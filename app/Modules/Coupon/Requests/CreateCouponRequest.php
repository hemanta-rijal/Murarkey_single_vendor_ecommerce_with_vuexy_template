<?php

namespace Modules\Coupon\Requests;

use App\Http\Requests\BaseRequest;

class CreateCouponRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'coupon' => 'required|string',
            'discount_type' => 'required',
            'discount' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',

        ];
    }
}
