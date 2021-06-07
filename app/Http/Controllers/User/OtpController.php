<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Modules\Users\Requests\SendSmsRequest;
use Modules\Users\Requests\VerifyOtpRequest;

class OtpController extends Controller
{

    public function sendSms(SendSmsRequest $request)
    {
        $otp = strval(rand(100000, 999999));

        $user = auth()->user();

        $user->sms_verify_token = $otp;

        $user->save();

        if (session()->has('buy_now')) {
            session()->flash('buy_now', session()->get('buy_now'));
        }

        sendSms($request->phone_number, 'Your verification code is ' . $otp . get_meta_by_key('site_name'));
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        $user = auth()->user();

        if (session()->has('buy_now')) {
            session()->flash('buy_now', session()->get('buy_now'));
        }

        return [
            'status' => $user->sms_verify_token == $request->otp,
        ];
    }

}
