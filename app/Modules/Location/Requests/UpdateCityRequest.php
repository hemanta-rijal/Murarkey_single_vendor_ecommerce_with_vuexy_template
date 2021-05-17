<?php


namespace Modules\Location\Requests;


use App\Http\Requests\BaseRequest;

class UpdateCityRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'state_id' => 'required'
        ];
    }
}