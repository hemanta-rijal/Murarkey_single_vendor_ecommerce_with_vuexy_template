<?php


namespace App\Modules\PaymentVerification\Repositiories;


use Gloudemans\Shoppingcart\Cart;

class PaymentVerificationRepository implements \App\Modules\PaymentVerification\Contracts\PaymentVerificationRepository
{
    public function verifyEsewa($data){
        $url = "https://uat.esewa.com.np/epay/transrec";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        dd($response);
        if(strpos($response,'Success')==true){
            return true;
        }
        return false;
    }

    public function paymentEsewa($carts){

        $url = "https://uat.esewa.com.np/epay/main";
        $data =[
            'amt'=> $carts['total'],
            'pdc'=> 0,
            'psc'=> 0,
            'txAmt'=> 0,
            'tAmt'=> $carts['total'],
            'pid'=>'ee2c3ca1-696b-4cc5-a6be-2c40d929d45',
            'scd'=> 'EPAYTEST',
            'su'=>route('esewa.verify').'?q=su',
            'fu'=>route('esewa.verify').'?q=fu'
        ];
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
    }
}