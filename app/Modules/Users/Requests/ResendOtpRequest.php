<?php


namespace App\Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class ResendOtpRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'phone_number' => 'required|exists:users,phone_number'
        ];
    }

}