<?php


namespace Modules\Products\Requests;


use App\Http\Requests\BaseRequest;

class UpdateOutStockRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'product_id' => 'required',
        ];
    }

}