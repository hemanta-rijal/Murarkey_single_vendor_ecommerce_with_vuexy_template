<?php

namespace Modules\Testimonial\Requests;

use App\Http\Requests\BaseRequest;

class CreateTestimonialRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'string|required',
            'image' => 'image|required|mimes:jpeg,bmp,jpg,png',
            'ratings' => 'required| numeric| min:1| max:5.1',
        ];
    }
}
