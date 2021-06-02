<?php

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