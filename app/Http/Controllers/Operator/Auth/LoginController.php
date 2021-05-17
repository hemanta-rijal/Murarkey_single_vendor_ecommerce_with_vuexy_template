<?php

namespace App\Http\Controllers\Operator\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Modules\Admin\Requests\UpdateAdminProfileRequest;
use Modules\Users\Requests\RepositionProfilePicRequest;
use Modules\Users\Requests\UploadProfilePicRequest;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $username = 'username';

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/operator/';

    /**
     * Where to redirect users after logging out.
     *
     * @var string
     */
    protected $redirectAfterLogout = '/operator';

    /**
     * The guard that should be used for the authentication.
     *
     * @var string
     */
    protected $guard = 'operator';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    public function showLoginForm()
    {
        return view('operator.auth.login');
    }

    protected function guard()
    {
        return \Auth::guard('operator');
    }


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function profile()
    {
        return view('admin.auth.profile');
    }

    public function imageUpload()
    {
        return view('admin.auth.image-upload');
    }


    public function postProfile(UpdateAdminProfileRequest $request)
    {
        $user = auth('admin')->user();

        $user->name = $request->name;
        if ($request->password)
            $user->password = bcrypt($request->password);

        $user->save();

        flash('Profile Updated successfully');

        return back();
    }

    public function uploadProfilePic(UploadProfilePicRequest $request)
    {
        $path = $request->profile_pic->store('public/profile-pics');

        $user = auth('admin')->user();

        $user->profile_pic = $path;

        $user->profile_pic_position = ['position_x' => '0px', 'position_y' => '0px'];

        $user->save();

        return back();
    }

    public function removeProfilePic()
    {
        $user = auth('admin')->user();

        $user->profile_pic = null;
        $user->profile_pic_position = ['position_x' => '0px', 'position_y' => '0px'];

        $user->save();

        return back();
    }

    public function rePositionProfilePic(RepositionProfilePicRequest $request)
    {
        $data = $request->all();
        $user = auth('admin')->user();

        $user->profile_pic_position = $request->only('position_x', 'position_y');

        $user->save();

        (new \Modules\Utilities\CropImage(storage_app_path($user->profile_pic), [parsePosition($data['position_x']), parsePosition($data['position_y'])], [100, 100]))->crop()->save();

        return back();
    }

}
