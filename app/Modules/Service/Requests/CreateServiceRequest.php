<?php

namespace Modules\Service\Requests;

use App\Http\Requests\BaseRequest;

class CreateServiceRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'string',
            'image' => 'image|required|mimes:jpeg,bmp,jpg,png',
            'ratings' => 'required| numeric| min:1| max:5.1',
        ];
    }
}
