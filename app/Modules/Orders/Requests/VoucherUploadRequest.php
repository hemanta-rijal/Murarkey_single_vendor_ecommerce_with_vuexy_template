<?php


namespace Modules\Orders\Requests;


use App\Http\Requests\BaseRequest;

class VoucherUploadRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'voucher_path' => 'required|image'
        ];
    }

}