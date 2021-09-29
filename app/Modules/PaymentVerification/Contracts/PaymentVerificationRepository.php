<?php

namespace App\Modules\PaymentVerification\Contracts;

interface PaymentVerificationRepository
{
    public function verifyEsewa($carts);

    public function paymentEsewa($data);

    public function store_esewa_verifcation($pid);

    public function get_esewa_pid($user_id);
}
