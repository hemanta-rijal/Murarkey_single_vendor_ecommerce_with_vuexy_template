<?php

namespace Modules\Users\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends BaseRequest
{
    public function rules()
    {
        $rules = [
//            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d).{8,}$/|confirmed',
//            'user.first_name' => 'required',
//            'user.last_name' => 'required',
            'user.phone_number' => 'required|unique:users,phone_number|regex:/^9+([7-8][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]+)/',
            'otp' => ['required', Rule::exists('temp_mobile_numbers')->where('no', $this->get('user')['phone_number'])->where('otp', $this->get('otp'))],
            //Seller

            'seller.position' => 'required_if:create_seller_company,1',
//            'seller.skype' => 'required_if:create_seller_company,1',
//            'seller.wechat' => 'required_if:create_seller_company,1',
//            'seller.viber' => 'required_if:create_seller_company,1',
//            'seller.whatsapp' => 'required_if:create_seller_company,1',
            'seller.mobile_number.0.type' => 'required_if:create_seller_company,1',
            'seller.mobile_number.0.number' => 'required_if:create_seller_company,1',
            'seller.landline_number.0.type' => 'required_if:create_seller_company,1',
            'seller.landline_number.0.number' => 'required_if:create_seller_company,1',
//            'seller.fax.1.type' => 'required_if:create_seller_company,1',
//            'seller.fax.1.number' => 'required_if:create_seller_company,1',

            //Company
            'company.name' => 'required_if:create_seller_company,1',
            'company.country_id' => 'required_if:create_seller_company,1',
            'company.province' => 'required_if:create_seller_company,1',
            'company.city' => 'required_if:create_seller_company,1',
            'company.products' => 'required_if:create_seller_company,1',
            'company.business_type' => 'required_if:create_seller_company,1',
            'company.operational_address' => 'required_if:create_seller_company,1',
        ];
        if (!hide_permit_upload()) $rules['government_business_permit'] = 'required_if:create_seller_company,1|file';

        return $rules;
    }


    public function messages()
    {
        return [
            'user.email.unique' => 'The email address you have entered is already registered.',
            'user.password.regex' => 'Password must be minimum 8 characters at least 1 Alphabet and 1 Number'
        ];
    }

}
