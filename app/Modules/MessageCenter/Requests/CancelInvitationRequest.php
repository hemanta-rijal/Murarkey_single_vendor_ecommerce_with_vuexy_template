<?php


namespace Modules\MessageCenter\Requests;


use App\Http\Requests\BaseRequest;

class CancelInvitationRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'id' => 'required'
        ];
    }
}