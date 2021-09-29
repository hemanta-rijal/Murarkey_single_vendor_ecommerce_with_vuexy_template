<?php

namespace App\Modules\PaymentVerification\Contracts;

interface PaymentVerificationServices
{
    public function verifyEsewa($carts, $request);

    public function paymentEsewa($carts);

    public function store_esewa_verifcation($pid);

    public function get_esewa_pid($user_id);
}
