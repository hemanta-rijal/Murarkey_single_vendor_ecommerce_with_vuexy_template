<?php

namespace Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class UpdateShipmentInfoRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'city' => 'required',
        ];
    }

}