<?php

namespace Modules\Users\Requests;

use App\Http\Requests\BaseRequest;

class ResetPasswordRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d).{8,}$/|confirmed',
            // 'identifier' => ['required', 'user_exists'],
            'token' => ['required'],
            // 'otp' => ['required', 'otp_verify_for_reset_password:' . $this->get('identifier')],
        ];
    }

}
