<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/24/18
 * Time: 12:53 PM
 */

namespace App\Modules\Cart\Requests;


use App\Http\Requests\BaseRequest;

class DiscountRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'item.product_id' => 'required|exists:products,id',
            'item.qty' => 'required|numeric'
        ];
    }
}