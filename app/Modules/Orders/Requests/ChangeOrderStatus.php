<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/24/18
 * Time: 7:24 PM
 */

namespace Modules\Orders\Requests;


use App\Http\Requests\BaseRequest;

class ChangeOrderStatus extends BaseRequest
{

    public function rules()
    {
        return [
            'status' => 'required'
        ];
    }

}