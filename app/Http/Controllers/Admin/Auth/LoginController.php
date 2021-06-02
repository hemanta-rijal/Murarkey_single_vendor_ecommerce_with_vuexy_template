<?php

namespace App\Http\Controllers\Admin\Auth;

use Throwable;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Modules\Users\Requests\UploadProfilePicRequest;
use Modules\Admin\Requests\UpdateAdminProfileRequest;
use Modules\Users\Requests\RepositionProfilePicRequest;

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
    protected $redirectTo = '/admin/';

    /**
     * Where to redirect users after logging out.
     *
     * @var string
     */
    protected $redirectAfterLogout = '/admin';

    /**
     * The guard that should be used for the authentication.
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    protected function guard()
    {
        return \Auth::guard('admin');
    }


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function viewProfile()
    {
        return view('admin.auth.view-profile');
    }
    public function editProfile()
    {
        return view('admin.auth.edit-profile');
    }

    public function imageUpload()
    {
        return view('admin.auth.image-upload');
    }


    public function postProfile(UpdateAdminProfileRequest $request)
    {
        try {
            $user = auth('admin')->user();
            $user->name = $request->name;
            // if($user->password==bcrypt($request->old_password))
            if ($request->new_password)
                $user->password = bcrypt($request->new_password);

            $user->save();
            flash('Profile Updated successfully')->success();
            return redirect()->route('admin.view-profile');
        } catch (\Throwable $th) {
            
            flash('Profile Could Not Be Updated Successfully')->error();
            return redirect()->route('admin.view-profile');
        }
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
