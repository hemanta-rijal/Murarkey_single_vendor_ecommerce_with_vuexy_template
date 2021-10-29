<?php


namespace Modules\Companies\Requests;


use App\Http\Requests\BaseRequest;

class ContactFormRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'g-recaptcha-response' => 'required|recaptcha',
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ];
    }

}