<?php


namespace Modules\Admin\Requests;


use App\Http\Requests\BaseRequest;

class UpdateContactUsRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'status' => 'required'
        ];
    }
}