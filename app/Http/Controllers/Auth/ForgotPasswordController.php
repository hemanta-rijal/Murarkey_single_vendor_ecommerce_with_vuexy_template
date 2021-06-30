<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Users\Requests\ForgetPasswordRequest;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
     */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('frontend.auth.passwords.pre-reset');
    }

    public function preForgetPassword(ForgetPasswordRequest $request)
    {
        $user = User::where('email', $request->identifier)->orWhere('phone_number', $request->identifier)->firstOrFail();

        $user->sms_verify_token = strval(rand(100000, 999999));

        $user->save();

        if ($user->phone_number) {
            sendSms($user->phone_number, get_meta_by_key('site_name') . 'password reset verification Code is ' . $user->sms_verify_token);
        }

        if ($user->email) {
            $this->broker()->sendResetLink(
                ['email' => $user->email]
            );
            Auth::guard('web')->login($user);
            Session()->flash('success', 'Reset email has been sent to you with OTP code. please check mailbox and verify.');
            return view('frontend.auth.passwords.verify-otp');
        }

    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  string $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkResponse($response)
    {
        session()->flash('success_message', true);

        return redirect('auth/login#success')->with('success', trans($response));
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request
     * @param  string $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return redirect('/auth/login#forget-password')
            ->withErrors(['forgetpassword-email' => trans($response)]);
    }
}
