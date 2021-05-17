<?php


namespace Modules\Location\Requests;


use App\Http\Requests\BaseRequest;

class UpdateAreaCodeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'area_code' => 'required|numeric'
        ];
    }
}