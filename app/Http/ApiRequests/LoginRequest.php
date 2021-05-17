<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 8/28/18
 * Time: 8:22 PM
 */

namespace App\Http\ApiRequests;


use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|string',
            'password' => 'required'
        ];
    }


}