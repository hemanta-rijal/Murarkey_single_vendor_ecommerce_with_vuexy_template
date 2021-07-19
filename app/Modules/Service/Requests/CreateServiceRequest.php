<?php

namespace Modules\Service\Requests;

use App\Http\Requests\BaseRequest;

class CreateServiceRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required|required',
            'description' => 'string| required',
            'featured_image' => 'image|required|mimes:jpeg,bmp,jpg,png',
            'icon_image' => 'image|required|mimes:jpeg,bmp,jpg,png',
            // 'ratings' => 'required| numeric| min:1| max:5.1',
        ];
    }
}
