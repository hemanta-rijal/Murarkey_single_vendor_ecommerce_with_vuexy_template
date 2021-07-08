<?php

namespace Modules\ServiceLabel\Requests;

use App\Http\Requests\BaseRequest;

class CreateServiceLabelRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:100',
            'value' => 'string|min:3|max:100',
        ];
    }
}
