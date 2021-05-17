<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 8/30/18
 * Time: 5:13 PM
 */

namespace App\Http\ApiRequests;


use App\Http\Requests\BaseRequest;

class ResendConfirmationRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email'
        ];
    }

}