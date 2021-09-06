<?php

namespace Modules\Currency\Requests;

use App\Http\Requests\BaseRequest;

class CreateCurrencyRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'currency_name' => 'required|min:3|max:100',
            'short_name' => 'required|min:3|max:100',
            'icon' => 'image',
            'symbol' => 'required|min:3|max:100',
            'rate' => 'required|min:3|max:100',
            'symbol_pacement' => 'string|min:3|max:100',
        ];
    }
}
