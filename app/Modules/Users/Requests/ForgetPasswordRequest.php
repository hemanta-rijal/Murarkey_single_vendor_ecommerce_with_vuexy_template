<?php


namespace Modules\Users\Requests;


use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ForgetPasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'identifier' => ['required', 'user_exists']
        ];
    }

}