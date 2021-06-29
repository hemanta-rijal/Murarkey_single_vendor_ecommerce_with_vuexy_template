<?php

namespace Modules\Users\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserInfoRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::guard('web')->user()->id,
            'phone_number' => 'required|regex:/^9+([7-8][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]+)/',
        ];
    }
}
