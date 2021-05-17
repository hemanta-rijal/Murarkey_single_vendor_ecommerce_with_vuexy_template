<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/26/18
 * Time: 2:13 PM
 */

namespace Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class UpdateShipmentInfoRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'city' => 'required',
        ];
    }

}