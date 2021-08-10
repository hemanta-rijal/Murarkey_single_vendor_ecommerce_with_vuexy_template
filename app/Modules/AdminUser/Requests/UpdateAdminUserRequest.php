<?php

namespace Modules\AdminUser\Requests;

use App\Http\Requests\BaseRequest;

class UpdateAdminUserRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'required|string|min:4|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'sometimes|regex:/^(?=.*[A-Za-z])(?=.*\d).{8,}$/|confirmed',
            // 'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/|confirmed',
            // 'last_name' => 'required',
            'role_id' => 'required',
            // 'phone_number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'The email address you have entered is already registered.',
            'password.regex' => 'Password must be minimum 8 characters at least 1 Alphabet and 1 Number',
        ];
    }
}
