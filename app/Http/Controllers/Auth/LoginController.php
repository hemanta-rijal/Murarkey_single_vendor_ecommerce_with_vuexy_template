<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Auth;
use App\Mail\UserEmailVerification;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Mail;
use Modules\Users\Contracts\UserRepository;
use Modules\Users\Services\SocialAccountService;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    protected $loginPath = '/auth/login';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $socialAccountService;
    protected $userRepository;

    public function __construct(SocialAccountService $socialAccountService, UserRepository $userRepository)
    {
        $this->middleware('guest', ['except' => 'logout']);

        $this->errorMessage = trans('auth.failed');

        $this->socialAccountService = $socialAccountService;

        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->credentials($request);

        $query = (new User)->newQuery();

        foreach ($credentials as $key => $value) {
            if (!Str::contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        $user = $query->first();

        // dd($user);

        if (is_null($user) || !$user) {
            // dd("user not registered");
            $this->errorMessage = 'Your are not registered with us. Please Register !';
            return $this->sendFailedLoginResponse($request);
        }

        if (Hash::check($credentials['password'], $user->password)) {

            if ($this->checkVerified($user)) {
                $this->guard()->login($user);
                return $this->sendLoginResponse($request);
            } else {
                //  dd("verification required");
                $this->errorMessage = 'Verification Required!';
            }
        } else {
            //  dd("Invalid password provided!");
            $this->errorMessage = 'Invalid password provided!';
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function checkVerified($user)
    {
        if ($user->verified) {
            return true;
        }

        auth()->logout();
        $this->errorMessage = 'Please verify your email address';
        session()->flash('not-verified', true);

        return false;
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        // dd("login failed with : sendFailedLoginResponse");
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => $this->errorMessage,
                'ram' => 'shaym',
            ]);
    }

    public function username()
    {
        return 'email';
    }

    public function resendVerification($email)
    {
        $user = $this->userRepository->findUserByEmail($email);

        Mail::to($user->email)->send(new UserEmailVerification($user));

        session()->flash('email-sent', true);

        return back();
    }

    public function redirectPath()
    {
        if (\request('back_to')) {
            return \request('back_to');
        } else {
            switch (auth()->user()->role) {
                case 'main-seller':
                    return '/user';
                    break;
                case 'associate-seller':
                    return '/user';
                    break;
                case 'ordinary-user':
                    return '/';
                    break;
                case 'user':
                    return '/';
                    break;
            }
        }
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = $this->socialAccountService->createOrGetUser(
                Socialite::driver('facebook')
                    ->fields([
                        'name',
                        'first_name',
                        'last_name',
                        'email',
                        'gender',
                        'verified',
                    ])->user()
            );
            auth()->login($user);

            return redirect()->route('home');
        } catch (ClientException $e) {
            abort(404);
        }
    }

    protected function credentials(Request $request)
    {
        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password' => $request->get('password')];
        } else {
            return ['phone_number' => $request->get('email'), 'password' => $request->get('password')];
        }
    }
}
