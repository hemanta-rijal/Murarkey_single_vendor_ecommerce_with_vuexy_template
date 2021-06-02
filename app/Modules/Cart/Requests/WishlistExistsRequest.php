<?php


namespace App\Modules\Cart\Requests;


use App\Http\Requests\BaseRequest;

class WishlistExistsRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'product_id' => 'required'
        ];
    }

}