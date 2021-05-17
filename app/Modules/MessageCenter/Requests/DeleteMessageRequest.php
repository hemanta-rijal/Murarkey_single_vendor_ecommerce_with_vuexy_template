<?php


namespace Modules\MessageCenter\Requests;


use App\Http\Requests\BaseRequest;

class DeleteMessageRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'conversation_id' => 'required',
            'message_id' => 'required'
        ];
    }
}