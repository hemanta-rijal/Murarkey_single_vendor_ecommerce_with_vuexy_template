<?php

namespace Modules\Users\Requests;

use App\Http\Requests\BaseRequest;

class ChangePasswordRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'current_password' => 'required | string',
            'newpassword' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d).{8,}$/|confirmed',

            // 'identifier' => ['required', 'user_exists'],
            // 'otp' => ['required', 'otp_verify_for_reset_password:' . $this->get('identifier')],
        ];
    }

}
