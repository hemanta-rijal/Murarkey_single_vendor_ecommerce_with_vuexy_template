<?php


namespace Modules\Location\Requests;


use App\Http\Requests\BaseRequest;

class CreateCityRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'state_id' => 'required'
        ];
    }
}