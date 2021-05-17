<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 5/20/19
 * Time: 8:39 AM
 */

namespace App\Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class PreRegisterRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'phone_number' => 'required|unique:users,phone_number|regex:/^9+([7-8][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]+)/',
        ];
    }
}