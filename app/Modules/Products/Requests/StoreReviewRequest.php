<?php

namespace Modules\Products\Requests;

use App\Http\Requests\BaseRequest;

class StoreReviewRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'rating' => 'required|numeric',
            'comment' => 'required|string',
        ];
    }

}
