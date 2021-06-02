<?php


namespace App\Modules\Auction\Requests;


use App\Http\Requests\BaseRequest;

class AuctionSalesRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'product_id' => 'required',
            'price' => 'required|numeric'
        ];
    }

}