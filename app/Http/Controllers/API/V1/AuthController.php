<?php

namespace App\Http\Controllers\API\V1;

use App\Http\ApiRequests\LoginRequest;
use App\Http\ApiRequests\ResendConfirmationRequest;
use App\Http\Resources\User\BillingDetailsResource;
use App\Http\Resources\User\ShipmentDetailsResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Wallet\WalletResource;
use App\Mail\UserEmailVerification;
use App\Models\TempMobileNumber;
use App\Models\User;
use App\Modules\Users\Requests\PhoneVerifyRequest;
use App\Modules\Users\Requests\PreRegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mail;
use Modules\Users\Contracts\UserRepository;
use Modules\Users\Contracts\UserService;
use Modules\Users\Requests\CreateUserRequest;
use Modules\Users\Requests\ForgetPasswordRequest;
use Modules\Users\Requests\ResetPasswordRequest;
use Modules\Wallet\Services\WalletService;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends BaseController
{
    use SendsPasswordResetEmails;
    protected $userService, $userRepository, $walletService;

    public function __construct(UserService $userService, UserRepository $userRepository, WalletService $walletService)
    {
        $this->walletService = $walletService;
        $this->userService = $userService;
        $this->userRepository = $userRepository;

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = auth()->user();
        $user->billing_details = $user->billinginfo;
        $user->shipment_details = $user->shipmentinfo;
        if ($user) {
            return response()->json(['user' => new UserResource($user), 'message' => 'successfully fetched ', 'status' => 200, 'success' => true]);
        } else {
            return response()->json(['message' => 'No authenticated User Found ', 'status' => 401, 'success' => false]);
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {

        auth()->logout();

        return response()->json(['success' => true, 'status' => 200, 'message' => 'Successfully logged out']);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $this->credentials($request);
        try {
            // attempt to verify the credentials and create a token for the user
            // $expire_date = Carbon::now()->addDay(2);
            // ['exp' => $expire_date]
            if (!$token = auth()->attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Unauthorized',
                    'status' => 401,
                ]);
            }
            // $user->firebase_token = $request->get('firebase_token');
            //        if ($user->isDirty('firebase_token')) $user->save();

            return $this->respondWithToken($token);

        } catch (\Throwable $th) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could not create token', 'message' => $th->getMessage(), 'status' => 500]);
        }

    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        // $expire_date = Carbon::now()->addDay(2);
        $expire_date = auth()->factory()->getTTL() * 60; // in sec
        $user = auth()->user();

        return response()
            ->json([

                'token_type' => 'bearer',
                'access_token' => $token,
                'expires_in' => $expire_date . " sec",
                'user' => new UserResource($user),
                'success' => true,
                'status' => 200,
                "message" => 'Successfully logged In',
            ])
            ->header('x-app-token', $token)
            ->header('x-token-expires', $expire_date . 'sec')
            ->header('x-app-user-id', $user->id)
            ->header('x-app-role', $user->role);

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
        return response()->json(['message' => 'mail sent', 'success' => true, 'status' => 200]);
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
                    'status' => 200,
                    'success' => true,
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

        return response()->json(['message' => 'sign up verification code is sent successfully', 'success' => true, 'status' => 200]);
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
            sendSms($user->phone_number, $message . $user->sms_verify_token);
        }

        if ($user->email) {
            $this->broker()->sendResetLink(
                ['email' => $user->email]
            );
        }
        return [
            'success' => true,
            'status' => 200,
            'otp' => $user->sms_verify_token,
            'message' => 'success',
        ];
    }

    public function reset(ResetPasswordRequest $request)
    {
        $user = User::where('email', $request->identifier)->orWhere('phone_number', $request->identifier)->firstOrFail();

        $user->forceFill([
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ])->save();

//        $this->guard()->login($user);

        returnSuccessJsonMessage('successfully reset');

    }

    public function billingDetails()
    {
        $user = auth()->user();
        if ($user->billinginfo != null) {
            return new BillingDetailsResource($user);
        }
        return response()->json([
            'success' => false,
            'status' => 401,
            'message' => 'Billing Details not updated yet',
        ]);
    }

    public function updateUser(Request $request)
    {
        try {
            $data = $request->only([
                'first_name',
                'last_name',
                'email',
                'phone_number',
            ]);
            $this->userService->updateUserInfo($data);
            return returnSuccessJsonMessage('successfully updated');
        } catch (Throwable $th) {
            return returnErrorJsonMessage($th->getMessage);
        }
        return returnErrorJsonMessage('could not update');
    }
    public function updateBillingDetails(Request $request)
    {
        $user = auth()->user();

        $data = $request->only([
            'country',
            'state',
            'city',
            'specific_address',
            'zip',
        ]);
        $user->billing_details = $data;
        if ($user->save()) {
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Billing Details Updated Successfully',
            ]);

        }
        return response()->json([
            'success' => false,
            'status' => 401,
            'message' => 'Billing Details not updated yet',
        ]);

    }

    public function ShipmentDetails()
    {
        $user = auth()->user();
        if ($user->shipmentinfo != null) {
            return new ShipmentDetailsResource($user);
        }
        return response()->json([
            'success' => false,
            'status' => 401,
            'message' => 'Shipment Details not updated yet',
        ]);
    }
    public function updateShipmentDetails(Request $request)
    {
        $user = auth()->user();
        $data = $request->only([
            'country',
            'state',
            'city',
            'specific_address',
            'zip',
        ]);
        $user->shipment_details = $data;
        if ($user->save()) {
            return returnSuccessJsonMessage('Shipment details updated successfully');

        }
        return returnErrorJsonMessage('shipment details not updated');

    }

    //wallet

    public function wallet()
    {
        $user = auth()->user();
        $transactions = $this->walletService->getAllByUserId($user->id);
        return WalletResource::collection($transactions);
    }

    public function updateWallet(Request $request)
    {
        try {
            $user = auth()->user();
            $data = $request->only([
                'user_id',
                'transaction_type',
                'payment_method',
                'description',
                'amount',
                'status',
            ]);

            $data['user_id'] = $data['user_id'] ?? $user->id;
            $data['description'] = $data['description'] ?? 'loaded successfully';
            $data['status'] = $data['status'] ?? true;

            $this->walletService->create($data);
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Wallet Updated Successfully',
            ]);

        } catch (\Throwable $th) {
            //throw $th
            return response()->json([
                'success' => false,
                'status' => 500,
                'error' => $th->getMessage(),
            ]);
        }

    }

}
