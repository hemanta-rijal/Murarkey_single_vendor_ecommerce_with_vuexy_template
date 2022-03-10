<?php

namespace Modules\PaymentVerification\Contracts;

interface PaymentVerificationServices
{
    public function verifyEsewa($carts, $request,$user);

    public function paymentEsewa($carts);

    public function store_esewa_verifcation($pid);

    public function get_esewa_pid($user_id);
    function get_user_by_pid($pid);
    function getPaymentIdForEsewa($user_id);
}
