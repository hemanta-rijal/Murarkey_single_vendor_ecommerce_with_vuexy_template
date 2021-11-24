<?php

namespace Modules\Users\Requests;

use App\Http\Requests\BaseRequest;

class UpdateShipmentInfoRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'city' => 'required',
            'state' => 'required',
            'specific_address' => 'required',
            'country' => 'required',
            'phone_number' => 'required',
        ];
    }

}
