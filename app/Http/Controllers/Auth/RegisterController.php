<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TempMobileNumber;
use App\Modules\Users\Requests\PreRegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Users\Contracts\UserService;
use Modules\Users\Requests\CreateUserRequest;

class RegisterController extends Controller
{
    protected $userService;

    protected $redirectTo = '/';

    public function __construct(UserService $userService)
    {
        $this->middleware('guest');

        $this->userService = $userService;
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
        // sendSms($no->no, 'Kabmart sign up verification Code is ' . $no->otp);
        $no->save();

        return response()->json(["status" => 200, "otp" => $no->otp]);
    }

    public function register(CreateUserRequest $request)
    {
        $data = $request->all();

        $user = $this->userService->create($data, $request->government_business_permit);

        event(new Registered($user));

        auth()->login($user);

//        return view('auth.register')->withModel(isset($data['create_seller_company']) ? 'seller-account' : 'ordinary-account');

        return redirect('/');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function verify($token)
    {
        if ($this->userService->verify($token)) {
            return redirect()->route('login')->withErrors([
                'email' => 'Your account is verified',
            ]);
        }

        return abort(404);
    }

}
