<?php

namespace Modules\PaymentVerification\Services;

use Modules\PaymentVerification\Contracts\PaymentVerificationRepository;
use Modules\PaymentVerification\Contracts\PaymentVerificationServices as PaymentServicesContracts;

class PaymentVerificationServices implements PaymentServicesContracts
{
    public $paymentVerificationRepository;

    public function __construct(PaymentVerificationRepository $paymentVerificationRepository)
    {
        $this->paymentVerificationRepository = $paymentVerificationRepository;
    }

    public function verifyEsewa($amount, $request,$user)
    {
        $data = [
            'amt' => $amount,
            'rid' => $request->refId,
            'pid' => $this->getPaymentIdForEsewa($user->id),
            'scd' => 'EPAYTEST',
        ];
        return $this->paymentVerificationRepository->verifyEsewa($data);
    }

    public function paymentEsewa($carts)
    {
        $this->paymentVerificationRepository->paymentEsewa($carts);
    }

    public function getPaymentIdForEsewa($user_id)
    {
        $pid = $this->get_esewa_pid($user_id);
        return $pid;
    }

    public function store_esewa_verifcation($data)
    {
        $data['pid'] = rand(1111111111, 9999999999);
        return $this->paymentVerificationRepository->store_esewa_verifcation($data);
    }

    public function get_esewa_pid($user_id)
    {
        return $this->paymentVerificationRepository->get_esewa_pid($user_id);
    }
    public function get_user_by_pid($pid){
        return $this->paymentVerificationRepository->get_user_by_pid($pid);
    }

}
