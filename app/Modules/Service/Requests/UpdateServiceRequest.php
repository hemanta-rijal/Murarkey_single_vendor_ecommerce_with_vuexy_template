<?php

namespace Modules\Service\Requests;

use App\Http\Requests\BaseRequest;

class UpdateServiceRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'string|max:300|min:10',
            'image' => 'image|sometimes|mimes:jpeg,bmp,jpg,png',
            'ratings' => 'required| numeric| min:1| max:5.1',
        ];
    }
}
