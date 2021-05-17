<?php


namespace Modules\MessageCenter\Requests;


use App\Http\Requests\BaseRequest;

class LoadMoreRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'skip' => 'required',
            'conversation_id' => 'required'
        ];
    }

}