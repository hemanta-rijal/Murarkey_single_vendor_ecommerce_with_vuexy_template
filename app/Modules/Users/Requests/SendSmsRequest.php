<?php


namespace Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class SendSmsRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone_number' => 'required|regex:/^9+([7-8][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]+)/'
        ];
    }

}