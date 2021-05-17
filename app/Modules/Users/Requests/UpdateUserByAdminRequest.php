<?php


namespace Modules\Users\Requests;


class UpdateUserByAdminRequest
{
    public function rules()
    {
        return [
            'user.email' => 'required|email|unique:users,email,'.$this->route('user'),
            'user.password' => 'confirmed',
            'user.first_name' => 'required',
            'user.last_name' => 'required',
            'user.role' => 'required',

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
        ];
    }

}