<?php

namespace App\Modules\Cart\Requests;


use App\Http\Requests\BaseRequest;

class DiscountRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'item.product_id' => 'required|exists:products,id',
            'item.qty' => 'required|numeric'
        ];
    }
}