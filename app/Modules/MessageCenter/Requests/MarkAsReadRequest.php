<?php


namespace Modules\MessageCenter\Requests;


use App\Http\Requests\BaseRequest;

class MarkAsReadRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'conversation_id' => 'required'
        ];
    }
}