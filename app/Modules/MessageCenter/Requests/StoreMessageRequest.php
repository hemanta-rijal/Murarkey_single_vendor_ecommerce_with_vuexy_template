<?php


namespace Modules\MessageCenter\Requests;


use App\Http\Requests\BaseRequest;

class StoreMessageRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'conversation_id' => 'required',
            'body' => 'required_if:type,text',
            'attachment' => 'required_if:type,attachment|file|max:10240'
        ];
    }
}