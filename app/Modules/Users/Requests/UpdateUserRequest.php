<?php

namespace Modules\Users\Requests;

use App\Http\Requests\BaseRequest;

class UpdateUserRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            // 'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'required',
            // 'phone_number' => 'required',
        ];
    }
}
