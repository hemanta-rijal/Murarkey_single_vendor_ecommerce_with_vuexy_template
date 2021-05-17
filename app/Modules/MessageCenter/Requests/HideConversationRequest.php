<?php


namespace Modules\MessageCenter\Requests;


use App\Http\Requests\BaseRequest;

class HideConversationRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'conversation_id' => 'required'
        ];
    }

}