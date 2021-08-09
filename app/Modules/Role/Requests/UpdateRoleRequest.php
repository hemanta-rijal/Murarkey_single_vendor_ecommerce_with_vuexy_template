<?php

namespace Modules\Role\Requests;

use App\Http\Requests\BaseRequest;

class UpdateRoleRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:100',
            'slug' => 'string|min:3|max:100',
        ];
    }
}
