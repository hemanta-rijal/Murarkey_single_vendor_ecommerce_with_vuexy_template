<?php

namespace Modules\Users\Requests;

use App\Http\Requests\BaseRequest;

class UploadProfilePicRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'profile_pic' => 'required|max:4096|image|dimensions:min_width=100,min_height=200',
        ];
    }

}
