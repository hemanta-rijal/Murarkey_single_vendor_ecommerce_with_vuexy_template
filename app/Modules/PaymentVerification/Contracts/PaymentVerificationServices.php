<?php

namespace App\Modules\PaymentVerification\Contracts;

interface PaymentVerificationServices
{
    public function verifyEsewa($carts,$request);

    public function paymentEsewa($carts);
}