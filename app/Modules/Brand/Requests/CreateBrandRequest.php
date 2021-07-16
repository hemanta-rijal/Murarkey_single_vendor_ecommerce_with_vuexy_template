<?php

namespace Modules\Brand\Requests;

use App\Http\Requests\BaseRequest;

class CreateBrandRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required|string',
            'image' => 'image|required|mimes:jpeg,bmp,jpg,png',
            'caption' => 'string|max:300',
        ];
    }
}
