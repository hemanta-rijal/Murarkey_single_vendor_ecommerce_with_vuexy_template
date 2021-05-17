<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/24/18
 * Time: 10:55 AM
 */

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