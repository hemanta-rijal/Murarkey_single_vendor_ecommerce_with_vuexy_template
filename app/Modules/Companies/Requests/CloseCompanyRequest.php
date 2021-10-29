<?php


namespace Modules\Companies\Requests;


use App\Http\Requests\BaseRequest;

class CloseCompanyRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'company_reason' => 'required'
        ];
    }
}