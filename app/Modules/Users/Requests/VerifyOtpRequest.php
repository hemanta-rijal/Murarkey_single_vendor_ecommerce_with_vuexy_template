<?php


namespace Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class VerifyOtpRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'otp' => 'required'
        ];
    }

}