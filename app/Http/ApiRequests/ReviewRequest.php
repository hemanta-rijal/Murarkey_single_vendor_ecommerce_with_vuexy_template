<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 9/26/18
 * Time: 4:08 PM
 */

namespace App\Http\ApiRequests;

use App\Http\Requests\BaseRequest;

class ReviewRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'rating' => 'required|integer|max:5',
            'comment' => 'required',
            'product_id' => 'required|exists:products,id',
        ];
    }

}
