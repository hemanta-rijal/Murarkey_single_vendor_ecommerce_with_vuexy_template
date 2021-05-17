<?php

namespace Modules\Products\Requests;

use App\Http\Requests\BaseRequest;

class FileUploadRequest extends BaseRequest
{
    public function rules()
    {
        return [
            request()->route('name') => 'required|max:4096|image|dimensions:min_width=300,min_height=300',
        ];
    }

    public function messages()
    {
        return [
            'image_size' => 'The product image must be greater than or equal to 300 pixels wide and 300 pixels tall.',
        ];
    }
}
