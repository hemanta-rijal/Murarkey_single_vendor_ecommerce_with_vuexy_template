<?php


namespace Modules\MessageCenter\Requests;


use App\Http\Requests\BaseRequest;

class PostNewInviteRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id'
        ];
    }
}