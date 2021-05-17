<?php


namespace Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class CreateSellerCompanyRequest extends BaseRequest
{
    public function rules()
    {
        $rules = [
            'seller.position' => 'required',
//            'seller.skype' => 'required',
//            'seller.wechat' => 'required',
//            'seller.viber' => 'required',
//            'seller.whatsapp' => 'required',
            'seller.mobile_number.0.type' => 'required',
            'seller.mobile_number.0.number' => 'required',
            'seller.landline_number.0.type' => 'required',
            'seller.landline_number.0.number' => 'required',
//            'seller.fax.1.type' => 'required',
//            'seller.fax.1.number' => 'required',

            //Company
            'company.name' => 'required',
            'company.country_id' => 'required',
            'company.province' => 'required',
            'company.city' => 'required',
            'company.products' => 'required',
            'company.business_type' => 'required',
            'company.operational_address' => 'required',
        ];

        if (!hide_permit_upload()) $rules['government_business_permit'] = 'required|file|max:25600';

        return $rules;
    }
}