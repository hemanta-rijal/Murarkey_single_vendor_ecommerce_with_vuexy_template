<?php


namespace Modules\Newsletter\Requests;


use App\Http\Requests\BaseRequest;

class CreateNewsletterSubscriberRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'subscriber_email' => 'email|required'
        ];
    }
}