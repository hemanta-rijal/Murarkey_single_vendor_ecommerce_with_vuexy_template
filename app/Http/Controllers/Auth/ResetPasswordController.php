<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Users\Contracts\UserRepository;
use Modules\Users\Requests\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
     */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest');

        $this->userRepository = $userRepository;
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string|null $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null, $email = null)
    {
        $user = $this->userRepository->findUserByEmail($email);

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email, 'user' => $user]
        );
    }

    /**
     * @param ResetPasswordRequest $request
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    // ResetPasswordRequest
    public function reset(ResetPasswordRequest $request)
    {
        $user = User::where('email', $request->identifier)->orWhere('phone_number', $request->identifier)->firstOrFail();
        try {
            $user->forceFill([
                'password' => bcrypt($request->password),
                'remember_token' => Str::random(60),
            ])->save();
            Session()->flash('success', 'Password reset successfully.');
            return redirect('/user');
        } catch (\Throwable $th) {
            //throw $th;
            Session()->flash('warning', $th->getMessage());
            return redirect()->back();
        }
        // $this->guard()->login($user);

        // return $request->expectsJson() ? ['status' => 200] : redirect('/');
        Session()->flash('danger', 'Can not reset password');
        return redirect()->back();

    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'password.regex' => 'Password must be minimum 8 characters at least 1 Alphabet and 1 Number',
        ];
    }

}
