<?php


namespace App\Modules\PaymentVerification\Services;


use App\Modules\PaymentVerification\Repositiories\PaymentVerificationRepository;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Support\Facades\Auth;
use Modules\Cart\Contracts\CartService;

class PaymentVerificationServices implements \App\Modules\PaymentVerification\Contracts\PaymentVerificationServices
{
    public $paymentVerificationRepository;

    public function __construct(PaymentVerificationRepository $paymentVerificationRepository)
    {
        $this->paymentVerificationRepository = $paymentVerificationRepository;
    }

    public function verifyEsewa($amount,$request){
//        $pid =
        $data =[
            'amt'=> $amount,
            'rid'=> $request->refId,
            'pid'=>$this->getPaymentIdForEsewa(),
            'scd'=> 'EPAYTEST'
        ];
        return   $this->paymentVerificationRepository->verifyEsewa($data);
    }

    public function paymentEsewa($carts){
        $this->paymentVerificationRepository->paymentEsewa($carts);
    }

    public function getPaymentIdForEsewa(){
        $items = Cart::content();
        $pid =0;
        foreach ($items as $item) {
            $pid += isset($item->options['timestamp']) ? $item->options['timestamp'] :0;
        }
        return $pid;
    }


}