<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 3/29/19
 * Time: 5:23 PM
 */

namespace Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class VerifyOtpRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'otp' => 'required'
        ];
    }

}