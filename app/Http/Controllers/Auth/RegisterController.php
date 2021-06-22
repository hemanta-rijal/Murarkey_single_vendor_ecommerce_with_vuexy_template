<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserEmailVerification;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Users\Contracts\UserService;
use Modules\Users\Requests\CreateUserRequest;
use Throwable;

class RegisterController extends Controller
{
    protected $userService;

    protected $redirectTo = '/';

    public function __construct(UserService $userService)
    {
        $this->middleware('guest');

        $this->userService = $userService;
    }

    public function register(CreateUserRequest $request)
    {
        $data = $request->all();
        if (checkEmailOrPhone($request->userId) == "invalid") {
            $request->session()->flash('danger', 'Invalid Email or Phone No');
            return redirect()->back();
        }

        if ($request->userId != null && User::where('email', $request->userId)->count() > 0) {
            $request->session()->flash('danger', 'Email should be unique');

            return redirect()->back();
        }
        if ($request->userId != null && User::where('phone_number', $request->userId)->count() > 0) {
            $request->session()->flash('danger', 'Phone number should be unique');
            return redirect()->back();
        }
        if (checkEmailOrPhone($request->userId) == "email") {
            $data['email'] = $request->userId;
            $data['email_verification_token'] = Str::random(32);

        }

        if (checkEmailOrPhone($request->userId) == "phone") {
            $data['phone_number'] = $request->userId;

            $data['sms_verify_token'] = strval(rand(100000, 999999));
            //Note:
            //this is auto verified coz we don have sms verificaion implimented we will do it later
            $data['verified'] = true;

        }

        //temperory verifying
        // $data['verified'] = true;

        if ($user = $this->userService->create($data)) {
            try {

                Mail::to($user->email)->send(new UserEmailVerification($user));
                // checkEmailOrPhone($request->userId) == "email" ? Mail::to($user->email)->send(new UserEmailVerification($user)) : sendOtpForRegistration($user);

            } catch (\Throwable $th) {
                flash("Verification token could not be sent")->error();
                flash($th->getMessage)->error();
            } catch (Exception $ex) {
                flash($ex->getMessage)->error();
            }

        } else {
            return redirect()->back()->with('error', "user not created");
        }
        event(new Registered($user));
        // Auth::guard('web')->login($user);
        flash('User registerd successfully. Please proceed to loging after verifying user ID.')->success();
        return redirect()->route('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    public function verify($token)
    {
        if ($this->userService->verify($token)) {
            flash('Your account has been verified')->success();
            return redirect()->route('login')->withErrors([
                'email' => 'Your account is verified',
            ]);
        }

        return abort(404);
    }

}
