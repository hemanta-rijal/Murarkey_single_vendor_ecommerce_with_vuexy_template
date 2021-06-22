<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\ThemeSettingController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Cart\Contracts\CartService;

class PaymentVerificationController extends Controller
{
    private $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function loadPayWithEsewaOption(Request $request){

        return view('frontend.partials.cart.esewaPaymentOption');
    }
    public function eSewaVerify(Request $request){
//        dd($request->all());
       //fetch cart services
        $carts = $this->cartService->getCartByUser(auth('web')->user());

        $url = "https://uat.esewa.com.np/epay/transrec";
        $data =[
            'amt'=> (int) str_replace(',','', $carts['total']),
            'rid'=> $request->refId,
            'pid'=>'ee2c3ca1-696b-4cc5-a6be-2c40d92',
            'scd'=> 'EPAYTEST'
        ];
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        if(strpos($response,'Success')==true){
            dd('Your Transaction is success');
        }else{
            dd('Your Transaction is failed');
        }
    }
}
