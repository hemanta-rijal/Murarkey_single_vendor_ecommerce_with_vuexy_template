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

    public function verifyEsewa($amount,$request){
        $data =[
            'amt'=> $amount,
            'rid'=> $request->refId,
            'pid'=>session()->getId(),
            'scd'=> 'EPAYTEST'
        ];
        return   $this->paymentVerificationRepository->verifyEsewa($data);
    }

    public function paymentEsewa($carts){
        $this->paymentVerificationRepository->paymentEsewa($carts);
    }


}