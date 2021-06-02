<?php


namespace App\Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class PhoneVerifyRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone_number' => 'required|exists:users,phone_number|regex:/^9+([7-8][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]+)/',
            'sms_verify_token' => 'required'
        ];
    }

}