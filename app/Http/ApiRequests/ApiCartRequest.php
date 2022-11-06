<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/4/18
 * Time: 9:10 AM
 */

namespace App\Http\ApiRequests;

use App\Http\Requests\BaseRequest;

class ApiCartRequest extends BaseRequest
{
    public function rules()
    {
     
        return [
            // 'product_id' => 'required|exists:products,id',
            // 'qty' => 'required'
        ];
    }
}
