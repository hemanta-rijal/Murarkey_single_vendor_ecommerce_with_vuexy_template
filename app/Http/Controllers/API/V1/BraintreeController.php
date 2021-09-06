<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree;

class BraintreeController extends Controller
{
    public function transaction(Request $request){
        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
        $clientToken = $gateway->clientToken()->generate();
        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $request->payment_method_nonce,
            'deviceData' => $request->device_data,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
        return response()->json(['success'=>true]);
    }


}
