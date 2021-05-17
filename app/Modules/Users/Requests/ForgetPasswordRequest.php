<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/26/18
 * Time: 11:54 AM
 */

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