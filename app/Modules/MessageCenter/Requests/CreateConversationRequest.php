<?php


namespace Modules\MessageCenter\Requests;


use App\Http\Requests\BaseRequest;

class CreateConversationRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'user_id' => 'required'
        ];
    }
}