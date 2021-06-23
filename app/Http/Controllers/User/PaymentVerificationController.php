<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\ThemeSettingController;
use App\Http\Controllers\Controller;
use App\Modules\PaymentVerification\Services\PaymentVerificationServices;
use Illuminate\Http\Request;
use Modules\Cart\Contracts\CartService;

class PaymentVerificationController extends Controller
{
    private $cartService;
    private $paymentVerificationServices;
    public function __construct(CartService $cartService,PaymentVerificationServices $paymentVerificationServices)
    {
        $this->cartService = $cartService;
        $this->paymentVerificationServices = $paymentVerificationServices;
    }

//    public function loadPayWithEsewaOption(Request $request){
//
//        return view('frontend.partials.cart.esewaPaymentOption');
//    }
    public function eSewaVerify(Request $request){
        $carts = $this->cartService->getCartByUser(auth('web')->user());
        $status = $this->paymentVerificationServices->paymentEsewa($carts,$request);
        dd($status);

    }
}
