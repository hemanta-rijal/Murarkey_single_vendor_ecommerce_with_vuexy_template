<?php

namespace App\Modules\PaymentVerification\Contracts;

interface PaymentVerificationRepository
{
    public function verifyEsewa($carts);

    public function paymentEsewa($data);
}