<?php

namespace Modules\Users\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends BaseRequest
{
    public function rules()
    {
        $rules = [
            'first_name' => 'required|string|min:4|max:100',
            'last_name' => 'required|string|min:4|max:100',
            'email' => 'required|email|unique:users,email',
            // 'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d).{8,}$/',

            // 'user.phone_number' => 'required|unique:users,phone_number|regex:/^9+([7-8][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]+)/',
            // 'otp' => ['required', Rule::exists('temp_mobile_numbers')->where('no', $this->get('user')['phone_number'])->where('otp', $this->get('otp'))],

        ];

        return $rules;
    }


    public function messages()
    {
        return [
            'email.unique' => 'The email address you have entered is already registered.',
            'password.regex' => 'Password must be minimum 8 characters at least 1 Alphabet, 1 Number and 1 Special Character'
        ];
    }

}
