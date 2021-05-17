<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 3/29/19
 * Time: 5:21 PM
 */

namespace Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class SendSmsRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone_number' => 'required|regex:/^9+([7-8][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]+)/'
        ];
    }

}