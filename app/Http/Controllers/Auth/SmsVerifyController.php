<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 3/8/19
 * Time: 5:13 PM
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Users\Requests\PhoneVerifyRequest;
use App\Modules\Users\Requests\ResendOtpRequest;
use Auth;

class SmsVerifyController extends Controller
{

    public function index()
    {
        return view('auth.phone-verify');
    }

    public function store(PhoneVerifyRequest $request)
    {

        $user = User::where('phone_number', $request->phone_number)->where('sms_verify_token', $request->sms_verify_token)->first();
        $errorMessage = '';
        if (!$user) {
            $errorMessage = 'Invalid OTP provided.';
            return view('auth.phone-verify', compact('errorMessage'))->with('dbuser', $user);
        }

        if ($user && !$user->verified) {
            $user->verified = 1;
            $user->save();
            Auth::login($user);
            return redirect('/');
        }

        $errorMessage = 'Already Verified.';
        return view('auth.phone-verify', compact('errorMessage'));
    }

    public function resendOtp(ResendOtpRequest $request)
    {
        $user = User::where('phone_number', $request->phone_number)->first();

        if ($user && !$user->verified) {
            $user->sms_verify_token = str_random(6);
            $user->save();
            sendOtpForRegistration($user);
        }

        $errorMessage = 'Already Verified.';
        return view('auth.phone-verify', compact('errorMessage'));
    }
}
