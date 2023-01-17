<?php

namespace App\Http\Controllers\API\V1;

use App\Http\ApiRequests\LoginRequest;
use App\Http\ApiRequests\ResendConfirmationRequest;
use App\Http\Resources\User\BillingDetailsResource;
use App\Http\Resources\User\ShipmentDetailsResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Wallet\WalletResource;
use App\Mail\UserEmailVerification;
use App\Mail\UserPasswordReset;
use App\Models\Currency;
use App\Models\TempMobileNumber;
use App\Models\User;
use App\Modules\Users\Requests\PhoneVerifyRequest;
use App\Modules\Users\Requests\PreRegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Users\Contracts\UserRepository;
use Modules\Users\Contracts\UserService;
use Modules\Users\Requests\ChangePasswordRequest;
use Modules\Users\Requests\CreateUserRequest;
use Modules\Users\Requests\ForgetPasswordRequest;
use Modules\Users\Requests\ResetPasswordRequest;
use Modules\Users\Requests\UploadProfilePicRequest;
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
        $field = filter_var($request->get('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';
        $credentials = [$field => $request->get('email'), 'password' => $request->get('password')];
        try {
            if (!$token = auth()->attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'error' => 'User name and password not match',
                    'status' => 401,
                ]);
            }

            $user = User::where($field, $request->get('email'))->first();
            return $this->respondWithTokenAndUser($token,$user);

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
    protected function respondWithTokenAndUser($token,$user)
    {
        $expire_date = auth()->factory()->getTTL() * 60; // in sec
        $session = session()->getId();

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
            ->header('x-app-role', $user->role)
            ->header('x-app-session',$session);
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
        $field = filter_var($request->get('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';
        return [$field => $request->get('email'), 'password' => $request->get('password')];
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

    public function sendResetLinkEmail(ResendConfirmationRequest $request)
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

            return response()->json(['data'=>'',"message"=>"Password reset sms has been sent to your phone number with otp code. please check mailbox and verify."],200);


        } elseif ($user->email == $request->identifier) {
            if ($user->email) {
                Mail::to($user->email)->send(new UserPasswordReset($user));

                // send email with otp code
                // $this->broker()->sendResetLink(
                //     ['email' => $user->email]
                // );

                // Auth::guard('web')->login($user);

            return response()->json(['data'=>'',"message"=>"Password reset email has been sent to your email address. please check mailbox and verify."],200);
                // return view('frontend.auth.passwords.reset')->with('token', $user->email_verification_token);
                // return view('frontend.auth.passwords.verify-otp');
            }
        }


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
        $token = null;
        $user = User::where('email', $request->identifier)->orWhere('phone_number', $request->identifier)->firstOrFail();

        $user->sms_verify_token = strval(rand(100000, 999999));
        $user->email_verification_token = md5($user->email);
        $user->verified = false;
        $user->save();

        if ($user->phone_number == $request->identifier) {
            $message = get_meta_by_key('site_name') . ' password reset verification Code is';
            sendSms($user->phone_number, $message . $user->sms_verify_token);
            $token = $user->sms_verify_token;

            // temporary: send email with otp code // for testing purpose
            $this->broker()->sendResetLink(
                ['email' => $user->email]
            );

            return [
                'success' => true,
                'status' => 200,
                'token' => $token,
                'message' => 'OTP code is sent to your phone number.  Please check messagebox and proceed to reset',
            ];

        } elseif ($user->email == $request->identifier) {
            Mail::to($user->email)->send(new UserPasswordReset($user));
            $token = $user->email_verification_token;
            // if ($user->email) {
            //     $this->broker()->sendResetLink(
            //         ['email' => $user->email]
            //     );
            // }
            return [
                'success' => true,
                'status' => 200,
                'token' => $token,
                'message' => 'Reset email set to your email address.  Please check mailbox and proceed to reset',
            ];
        }
        return [
            'success' => false,
            'status' => 500,
            'token' => $token,
            'message' => 'Your account could not be found !!!',
        ];
    }

    public function reset(ResetPasswordRequest $request)
    {
        $user = User::where('email', $request->identifier)->orWhere('phone_number', $request->identifier)->firstOrFail();

        $user->forceFill([
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        returnSuccessJsonMessage('successfully reset');

    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = auth()->user();
            if ($user && Hash::check($request->current_password, $user->password)) {

                if ($request->newpassword == $request->newpassword_confirmation) {
                    $user->forceFill([
                        'password' => bcrypt($request->newpassword),
                    ])->save();
                    auth()->logout();
                    return response()->json([
                        'success' => true,
                        'status' => 200,
                        'message' => "password changed successfully '\n' please try log in with new password",
                    ]);

                }
                return response()->json([
                    'success' => false,
                    'status' => 500,
                    'message' => 'new password did not confirmed',
                ]);

            }
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Current password did not matched our record',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'New Password Could Not be updated',
            ]);

        }

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
            $this->userService->updateUserInfo($data, auth()->user()->id);
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
        if ($user->save()) return returnSuccessJsonMessage('Shipment details updated successfully');
        return returnErrorJsonMessage('shipment details not updated');

    }

    public function wallet()
    {
        $user = $this->userService->getLogedInUser();
        $transactions = $this->walletService->getAllByUserId($user->id);
        return WalletResource::collection($transactions);
    }

    public function totalWalletAmount(){

        $balance = (double) $this->walletService->getWalletAmountByUser($this->userService->getLogedInUser()->id);
        return response()->json(['data'=>['amount'=>$balance]],200);
    }

    public function updateWallet(Request $request)
    {
        try {
            $user = $this->userService->getLogedInUser();
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

    //user profile pictures
    public function uploadProfilePic(UploadProfilePicRequest $request)
    {
        try {
            $path = $request->profile_pic->store('public/profile-pics');
            $user = $this->userService->getLogedInUser();
            $user->profile_pic = $path;
            $modificationDetails = ["zoom" => "0", "position" => ["x" => "0", "y" => "0"]];
            $user->profile_pic_position = $modificationDetails;
            $user->save();

            $croppedPath = (new \Modules\Utilities\NewCropImage(storage_app_path($path), [User::DEFAULT_PROFILE_PIC_SIZE, User::DEFAULT_PROFILE_PIC_SIZE]))->resize()->crop()->save();

            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Profie picture updates successfully ',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Could not be updated',
            ]);

        }

    }

    public function removeProfilePic()
    {
        try {
            $user = auth()->user();

            $user->profile_pic = null;
            $user->profile_pic_position = ["zoom" => "0", "position" => ["x" => "0", "y" => "0"]];

            $user->save();
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Profie picture deleted successfully ',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'could not be deleted',
            ]);

        }

    }

    // public function rePositionProfilePic(RepositionProfilePicRequest $request)
    // {
    //     $data = $request->all();
    //     $user = Auth::guard('web')->user();

    //     $user->profile_pic_position = $request->only('position_x', 'position_y');

    //     $user->save();

    //     (new \Modules\Utilities\CropImage(storage_app_path($user->profile_pic), [parsePosition($data['position_x']), parsePosition($data['position_y'])], [100, 100]))->crop()->save();

    //     return back();
    // }

    public function convertCurrency(Request $request)
    {
        $converted_amt = 0;
        $to = $request->to;
        $user = auth()->user();
        if ($to) {
            $to = Currency::where('short_name', $request->to)->first();
            if ($to == null) {
                return response()->json([
                    'success' => false,
                    'status' => 500,
                    'data' => null,
                    'message' => 'could not convert',
                ]);
            }
        } elseif ($user != null && $user->supported_currency != null) {
            $to = Currency::where('short_name', $user->supported_currency)->first();
        } else {
            return response()->json([
                'success' => false,
                'status' => 500,
                'data' => null,
                'message' => 'could not convert',
            ]);

        }
        if ($to) {
            $amt = (round($request->amount * $to->rate, '2'));
        } else {
            $converted_amt = 'Rs. ' . $request->amount;
        }

        if ($to->placement == 'front') {
            $converted_amt = $to->symbol . '. ' . $amt;
        } else {
            $converted_amt = $amt . ' ' . $to->symbol;
        }
        return response()->json([
            'success' => true,
            'status' => 200,
            'data' => $converted_amt,
            'message' => 'converted successfully',
        ]);

    }
    public function loginByGoogle(Request $request){

        $input = $request->input('accessToken');

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, 'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=' . $input);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($curl_handle));
        curl_close($curl_handle);
        if (!isset($response->email)) {
            return response()->json(['error' => 'wrong google token / this google token is already expired.'], 401);
        }

        $user = User::where('email', $response->email)->first();
        if (!$user) {
            $user = new User();
            $user->first_name = $request->name;
            $user->email = $response->email;
            $user->password = bcrypt('Abcde');
            $user->verified = 1;
            $user->save();
        }

        try {
            $token= auth()->guard('api')->login($user);
            $this->respondWithTokenAndUser($token,$user);
//            return response()->json([
//                'access_token' => $token,
//                'token_type' => 'bearer',
//                'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
//            ]);
//            if (!$token = auth()->attempt($credentials)) {
//                return response()->json([
//                    'success' => false,
//                    'error' => 'User name and password not match',
//                    'status' => 401,
//                ]);
//            }
//            return $this->respondWithToken($token);

        } catch (\Throwable $th) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could not create token', 'message' => $th->getMessage(), 'status' => 500]);
        }
    }

    public function myStat(){
        $data = [

        ];
    }


}
