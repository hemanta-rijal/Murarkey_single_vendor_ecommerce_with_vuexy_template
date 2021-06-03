<?php


namespace App\Http\Controllers\API\V1;


use Modules\Users\Requests\SendSmsRequest;
use Modules\Users\Requests\VerifyOtpRequest;

class OtpController extends BaseController
{

    public function sendSms(SendSmsRequest $request)
    {

        $otp = strval(rand(100000, 999999));

        $user = auth()->user();

        $user->sms_verify_token = $otp;

        $user->save();

        sendSms($request->phone_number, 'Your verification code is ' . $otp . '.KABMART');
    }


    public function verifyOtp(VerifyOtpRequest $request)
    {
        $user = $this->auth->user();

        return [
            'status' => $user->sms_verify_token == $request->otp
        ];
    }

}