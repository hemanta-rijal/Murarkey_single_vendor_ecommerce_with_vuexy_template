<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 2/9/19
 * Time: 3:42 PM
 */

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