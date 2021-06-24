<?php

namespace Modules\Wallet\Requests;

use App\Http\Requests\BaseRequest;

class CreateWalletRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'string',
            'image' => 'image|required|mimes:jpeg,bmp,jpg,png',
            'caption' => 'string|max:300',
        ];
    }
}
