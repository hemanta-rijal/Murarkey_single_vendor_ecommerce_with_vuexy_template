<?php


namespace Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class UpdateUserPasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'current_password' => 'required|old_password',
            'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d).{8,}$/|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Password must be minimum 8 characters at least 1 Alphabet and 1 Number',
            'old_password' => 'Current password doesn\'t match, Please try again'
        ];
    }
}