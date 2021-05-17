<?php


namespace Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class UploadBase64ImageRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'base64_image_data' => 'required|is_png',
            'modification_details' => 'required'
        ];
    }

}