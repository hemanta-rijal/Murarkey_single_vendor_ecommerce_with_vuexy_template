<?php


namespace Modules\Location\Requests;


use App\Http\Requests\BaseRequest;

class CreateAreaCodeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'area_code' => 'required|numeric'
        ];
    }
}