<?php


namespace Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class CloseUserAccountRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'user_reason' => 'required'
        ];
    }

}