<?php

namespace App\Http\Controllers\API\V1;

use App\Http\ApiRequests\LoginRequest;
use App\Http\ApiRequests\ResendConfirmationRequest;
use App\Http\Resources\User\UserResource;
use App\Mail\UserEmailVerification;
use App\Models\TempMobileNumber;
use App\Models\User;
use App\Modules\Users\Requests\PhoneVerifyRequest;
use App\Modules\Users\Requests\PreRegisterRequest;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mail;
use Modules\Users\Contracts\UserRepository;
use Modules\Users\Contracts\UserService;
use Modules\Users\Requests\CreateUserRequest;
use Modules\Users\Requests\ForgetPasswordRequest;
use Modules\Users\Requests\ResetPasswordRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends BaseController
{
    use SendsPasswordResetEmails;

    public function __construct(UserService $userService, UserRepository $userRepository)
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;

    }

    public function login(LoginRequest $request)
    {
        $credentials = $this->credentials($request);
        try {
            // attempt to verify the credentials and create a token for the user
            $expire_date = Carbon::now()->addMinute(30);
            if (!$token = JWTAuth::attempt($credentials, ['exp' => $expire_date])) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = auth()->user();

//        $user->firebase_token = $request->get('firebase_token');
        //        if ($user->isDirty('firebase_token')) $user->save();

        return response()
            ->json([
                'status' => 'ok',
                'token' => $token,
                'user' => new UserResource($user),
            ])
            ->header('x-app-token', $token)
            ->header('x-token-expires', Carbon::now()->diffInSeconds($expire_date))
            ->header('x-app-user-id', Auth::user()->id)
            ->header('x-app-role', Auth::user()->role);

    }

    /**
     * Login user
     *
     * login with a `username` and `password`.
     *
     * @Post("/auth/login")
     * @Versions({"v1"})
     * @Transaction({
     *      @Request({"username": "foo1", "password": "bar"}),
     *      @Response(200, body={"status": "ok", "token": "{token}", "user": {} }),
     *      @Response(401, body={"error": "invalid_credentials"})
     * })
     */

    protected function credentials(LoginRequest $request)
    {
        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password' => $request->get('password')];
        } else {
            return ['phone_number' => $request->get('email'), 'password' => $request->get('password')];
        }
    }

    /**
     * Register user
     *
     * Register a new user with a `username` and `password`.
     *
     * @Post("/auth/register")
     * @Versions({"v1"})
     * @Transaction({
     *      @Request({"user": "foo", "password": "bar"}),
     *      @Response(200, body={"status": "ok", "token": "{token}", "user": {} }),
     *      @Response(401, body={"error": "invalid_credentials"})
     * })
     */

    public function register(CreateUserRequest $request)
    {
        $data = $request->all();
        $user = $this->userService->create($data);
        event(new Registered($user));
        return new UserResource($user);
    }

    /**
     * Resend Confirmation Mail
     *
     * @Post("/auth/resend-confirmation")
     * @Versions({"v1"})
     * @Transaction({
     *      @Request({"email": "sample@gmail.com"}),
     *      @Response(200, body={"email": "sent"}),
     * })
     */

    public function resendVerification(ResendConfirmationRequest $request)
    {
        $user = $this->userRepository->findUserByEmail($request->email);

        Mail::to($user->email)->send(new UserEmailVerification($user));
        return ['email' => 'sent'];
    }

    public function refresh()
    {
        return ['status' => 'ok'];
    }

    public function sendResetLinkEmail(ForgetPasswordRequest $request)
    {

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response;
    }

    public function smsVerify(PhoneVerifyRequest $request)
    {
        $user = User::where('phone_number', $request->phone_number)->where('sms_verify_token', $request->sms_verify_token)->first();

        $errorMessage = '';
        if (!$user) {
            $errorMessage = 'Invalid OTP provided.';
            return ['status' => 'invalid', 'message' => $errorMessage];
        }

        if ($user && !$user->verified) {
            $user->verified = 1;
            $user->save();
            $token = JWTAuth::fromUser($user);

            return response()
                ->json([
                    'status' => 'ok',
                    'token' => $token,
                    'user' => $user,
                ]);
        }

        $errorMessage = 'Already Verified.';

        return ['status' => 'invalid', 'message' => $errorMessage];
    }

    public function preRegister(PreRegisterRequest $request)
    {
        try {
            $no = TempMobileNumber::where('no', $request->phone_number)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $no = new TempMobileNumber();
            $no->no = $request->phone_number;
        }
        $no->otp = rand(100000, 999999);
        $message = get_meta_by_key('site_name') . ' sign up verification Code is';
        sendSms($no->no, $message . $no->otp);
        $no->save();

        return ["status" => 200];
    }

    /**
     * @param ForgetPasswordRequest $request
     */
    public function preForgetPassword(ForgetPasswordRequest $request)
    {
        $user = User::where('email', $request->identifier)->orWhere('phone_number', $request->identifier)->firstOrFail();

        $user->sms_verify_token = strval(rand(100000, 999999));

        $user->save();

        if ($user->phone_number) {
            $message = get_meta_by_key('site_name') . ' password reset verification Code is';
        }

        sendSms($user->phone_number, $message . $user->sms_verify_token);

        if ($user->email) {
            $this->broker()->sendResetLink(
                ['email' => $user->email]
            );
        }

        return ['status' => 2000];
    }

    public function reset(ResetPasswordRequest $request)
    {
        $user = User::where('email', $request->identifier)->orWhere('phone_number', $request->identifier)->firstOrFail();

        $user->forceFill([
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ])->save();

//        $this->guard()->login($user);

        return ['status' => 200];
    }

}
