<?php


namespace Modules\Location\Requests;


use App\Http\Requests\BaseRequest;

class GetLocationInfoRequest extends BaseRequest
{
    public function rules()
    {
        return [
          'type' => 'required'
        ];
    }
}