<?php


namespace Modules\Admin\Requests;


use App\Http\Requests\BaseRequest;

class UpdateAdminProfileRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'password' => 'confirmed'
        ];
    }
}