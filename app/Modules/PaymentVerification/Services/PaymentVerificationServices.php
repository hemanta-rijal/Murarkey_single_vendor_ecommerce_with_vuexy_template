<?php


namespace App\Modules\PaymentVerification\Services;


use App\Modules\PaymentVerification\Repositiories\PaymentVerificationRepository;
use Gloudemans\Shoppingcart\Cart;
use Modules\Cart\Contracts\CartService;

class PaymentVerificationServices implements \App\Modules\PaymentVerification\Contracts\PaymentVerificationServices
{
    public $paymentVerificationRepository;

    public function __construct(PaymentVerificationRepository $paymentVerificationRepository)
    {
        $this->paymentVerificationRepository = $paymentVerificationRepository;
    }

    public function verifyEsewa($carts,$request){
        $data =[
            'amt'=> (int) str_replace(',','', $carts['total']),
            'rid'=> $request->refId,
            'pid'=>'ee2c3ca1-696b-4cc5-a6be-2c40d929d45',
            'scd'=> 'EPAYTEST'
        ];
        return   $this->paymentVerificationRepository->verifyEsewa($data);
    }

    public function paymentEsewa($carts){
        $this->paymentVerificationRepository->paymentEsewa($carts);
    }


}