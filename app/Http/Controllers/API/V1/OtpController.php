<?php

namespace App\Http\Controllers\API\V1;

use App\Mail\UserEmailVerification;
use Illuminate\Support\Facades\Mail;
use Modules\Users\Requests\SendSmsRequest;
use Modules\Users\Requests\VerifyOtpRequest;

class OtpController extends BaseController
{

    public function sendSms(SendSmsRequest $request)
    {
        try {
            $otp = strval(rand(100000, 999999));
            $user = auth()->user();
            $user->sms_verify_token = $otp;
            $user->save();
            if ($request->has('phone_number')) {
                sendSms($request->phone_number, 'From : ' . get_meta_by_key('site_name') . 'Your verification code is ' . $otp);
            } else {
                Mail::to($request->email)->send(new UserEmailVerification($user));
            }
            return response()->json([
                'message' => 'Otp send successfully',
                'success' => true,
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(), 500]);
        }
    }
    public function verifyOtp(VerifyOtpRequest $request)
    {
        $user = auth()->user();
        if ($user->sms_verify_token == $request->otp) {
            return response()->json([
                'message' => 'successfully verified',
                'success' => true,
                'status' => 200,
            ]);

        } else {
            return response()->json([
                'message' => 'could not verified',
                'success' => false,
                'status' => 500,
            ]);
        }

    }

}
