<?php

namespace Modules\Users\Requests;

use App\Http\Requests\BaseRequest;

class UpdateBillingInfoRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'city' => 'required',
            'state' => 'required',
            'specific_address' => 'required',
            'country' => 'required',
            'zip' => 'required',
        ];
    }

}
