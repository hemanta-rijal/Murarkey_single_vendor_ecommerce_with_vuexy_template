<?php

namespace Modules\Brand\Requests;

use App\Http\Requests\BaseRequest;

class UpdateBrandRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            // 'description' => 'string|max:300|min:10',
            // 'image' => 'image|sometimes|mimes:jpeg,bmp,jpg,png',
            // 'caption' => 'string|max:300|min:10',
        ];
    }
}
