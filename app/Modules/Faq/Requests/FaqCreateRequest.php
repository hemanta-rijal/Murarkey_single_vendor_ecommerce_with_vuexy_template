<?php

namespace Modules\Faq\Requests;

use App\Http\Requests\BaseRequest;

class FaqCreateRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'question' => 'string|required|min:3|max:191',
            'answer' => 'string|required|min:3|max:1000',
        ];
    }
}
