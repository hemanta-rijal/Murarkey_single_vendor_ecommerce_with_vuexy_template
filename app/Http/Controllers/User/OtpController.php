<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 3/29/19
 * Time: 5:17 PM
 */

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

        sendSms($request->phone_number, 'Your verification code is ' . $otp. '.KABMART');
    }


    public function verifyOtp(VerifyOtpRequest $request)
    {
        $user = auth()->user();


        if (session()->has('buy_now')) {
            session()->flash('buy_now', session()->get('buy_now'));
        }

        return [
            'status' => $user->sms_verify_token == $request->otp
        ];
    }

}