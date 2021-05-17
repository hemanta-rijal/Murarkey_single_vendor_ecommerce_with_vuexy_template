<?php


namespace Modules\Users\Requests;


use App\Http\Requests\BaseRequest;

class CreateUserByAdminRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/|confirmed',
            'user.first_name' => 'required',
            'user.last_name' => 'required',
            'user.role' => 'required',
            'user.phone_number' => 'required',

            //Seller

            'seller.position' => 'required_if:user.role,associate-seller,main-seller',
//            'seller.skype' => 'required_if:create_seller_company,1',
//            'seller.wechat' => 'required_if:create_seller_company,1',
//            'seller.viber' => 'required_if:create_seller_company,1',
//            'seller.whatsapp' => 'required_if:create_seller_company,1',
            'seller.mobile_number.0.type' => 'required_if:user.role,associate-seller,main-seller',
            'seller.mobile_number.0.number' => 'required_if:user.role,associate-seller,main-seller',
            'seller.landline_number.0.type' => 'required_if:user.role,associate-seller,main-seller',
            'seller.landline_number.0.number' => 'required_if:user.role,associate-seller,main-seller',
            'seller.company_id' => 'required_if:user.role,associate-seller',
//            'seller.fax.1.type' => 'required_if:create_seller_company,1',
//            'seller.fax.1.number' => 'required_if:create_seller_company,1',

            //Company
            'company.name' => 'required_if:user.role,main-seller',
            'company.country_id' => 'required_if:user.role,main-seller',
            'company.province' => 'required_if:user.role,main-seller',
            'company.city' => 'required_if:user.role,main-seller',
            'company.products' => 'required_if:user.role,main-seller',
            'company.business_type' => 'required_if:user.role,main-seller',
            'company.operational_address' => 'required_if:user.role,main-seller',
            'government_business_permit' => 'file|max:25600',
        ];
    }

    public function messages()
    {
        return [
            'user.email.unique' => 'The email address you have entered is already registered.',
            'user.password.regex' => 'Password must be minimum 8 characters at least 1 Alphabet and 1 Number'
        ];
    }
}