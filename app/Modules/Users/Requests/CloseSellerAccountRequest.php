<?php


namespace Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class CloseSellerAccountRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'seller_reason' => 'required'
        ];
    }
}