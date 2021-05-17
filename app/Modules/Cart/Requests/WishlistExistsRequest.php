<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 1/4/19
 * Time: 11:37 AM
 */

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