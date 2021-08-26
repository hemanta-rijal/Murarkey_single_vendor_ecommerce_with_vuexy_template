<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserPasswordReset;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $user->email_verification_token = md5($user->email);
        $user->verified = false;
        $user->save();

        if ($user->phone_number == $request->identifier) {
            sendSms($user->phone_number, get_meta_by_key('site_name') . 'password reset verification Code is ' . $user->sms_verify_token);
            // temporary: send email with otp code
            $this->broker()->sendResetLink(
                ['email' => $user->email]
            );

            Session()->flash('success', 'Password reset message has been sent to your phone number. please check messagebox and verify.');
            return view('frontend.auth.passwords.verify-otp');

        } elseif ($user->email == $request->identifier) {
            if ($user->email) {
                Mail::to($user->email)->send(new UserPasswordReset($user));

                // send email with otp code
                // $this->broker()->sendResetLink(
                //     ['email' => $user->email]
                // );

                // Auth::guard('web')->login($user);

                Session()->flash('logging_message', 'Password reset email has been sent to your email address with otp code. please check mailbox and verify.');
                return redirect()->route('login');
                // return view('frontend.auth.passwords.reset')->with('token', $user->email_verification_token);
                // return view('frontend.auth.passwords.verify-otp');
            }
        }
        Session()->flash('error', 'Could not find your account.');
        return redirect()->back();
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
