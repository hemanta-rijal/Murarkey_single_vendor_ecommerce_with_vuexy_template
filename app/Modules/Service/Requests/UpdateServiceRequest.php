<?php

namespace Modules\Service\Requests;

use App\Http\Requests\BaseRequest;

class UpdateServiceRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required|required',
            'description' => 'string| required',
            // 'featured_images' => 'image|sometimes|mimes:jpeg,bmp,jpg,png',
            'icon_image' => 'image|sometimes|mimes:jpeg,bmp,jpg,png',
            // 'image' => 'image|sometimes|mimes:jpeg,bmp,jpg,png',
            // 'ratings' => 'required| numeric| min:1| max:5.1',
        ];
    }
}
