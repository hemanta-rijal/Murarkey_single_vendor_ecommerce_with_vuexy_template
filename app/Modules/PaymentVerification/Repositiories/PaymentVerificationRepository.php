<?php

namespace App\Modules\PaymentVerification\Repositiories;

use Exception;
use Illuminate\Support\Facades\DB;

class PaymentVerificationRepository implements \App\Modules\PaymentVerification\Contracts\PaymentVerificationRepository
{
    public function verifyEsewa($data)
    {
        $url = "https://uat.esewa.com.np/epay/transrec";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        if (strpos($response, 'Success') == true) {
            return true;
        }
        return false;
    }

    public function paymentEsewa($carts)
    {

        $url = "https://uat.esewa.com.np/epay/main";
        $data = [
            'amt' => $carts['total'],
            'pdc' => 0,
            'psc' => 0,
            'txAmt' => 0,
            'tAmt' => $carts['total'],
            'pid' => 'ee2c3ca1-696b-4cc5-a6be-2c40d929d45',
            'scd' => 'EPAYTEST',
            'su' => route('esewa.verify') . '?q=su',
            'fu' => route('esewa.verify') . '?q=fu',
        ];
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
    }

    public function store_esewa_verifcation($data)
    {
        // dd($data);
        try {

            \DB::table('esewa_payment_verification')
                ->where('user_id', $data['user_id'])
                ->delete()
            // ->update([
            //     'is_expired' => true,
            // ])
            ;

            \DB::table('esewa_payment_verification')->insert([
                'esewa_pid' => $data['pid'],
                'user_id' => $data['user_id'],
            ]);
            return true;
        } catch (Exception $ex) {
            return false;
        }

    }

    public function get_esewa_pid($user_id)
    {
        $esewa_payment_verification = DB::table('esewa_payment_verification')
            ->where(['user_id' => $user_id, 'is_expired' => false])
            ->first();
        return $esewa_payment_verification->esewa_pid;
    }
}
