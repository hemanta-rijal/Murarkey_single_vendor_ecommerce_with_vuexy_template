<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/26/18
 * Time: 12:32 PM
 */

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