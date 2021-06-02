<?php


namespace Modules\Products\Requests;


use App\Http\Requests\BaseRequest;

class CanReviewRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id'
        ];
    }

}