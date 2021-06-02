<?php


namespace App\Modules\Cart\Requests;


use App\Http\Requests\BaseRequest;

class CheckoutRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'user.name' => 'required',
            'user.address' => 'required',
            'user.phone_number' => 'required',
            'user.city' => 'required',

            'payment_method' => 'required'
        ];
    }
}