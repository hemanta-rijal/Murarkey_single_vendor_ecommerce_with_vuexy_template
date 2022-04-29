<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic;
use Modules\Companies\Contracts\CompanyService;
use Modules\Companies\Requests\CloseCompanyRequest;
use Modules\PaymentVerification\Contracts\PaymentVerificationServices;
use Modules\Users\Contracts\UserService;
use Modules\Users\Requests\CloseSellerAccountRequest;
use Modules\Users\Requests\CloseUserAccountRequest;
use Modules\Users\Requests\CreateSellerCompanyRequest;
use Modules\Users\Requests\RepositionProfilePicRequest;
use Modules\Users\Requests\UpdateBillingInfoRequest;
use Modules\Users\Requests\UpdateCompanyInfoRequest;
use Modules\Users\Requests\UpdateSellerInfoRequest;
use Modules\Users\Requests\UpdateShipmentInfoRequest;
use Modules\Users\Requests\UpdateUserPasswordRequest;
use Modules\Users\Requests\UploadBase64ImageRequest;
use Modules\Users\Requests\UploadProfilePicRequest;
use Modules\Wallet\Contracts\WalletService;


class UserController extends Controller
{
    protected $companyService;
    protected $walletService;
    private $userService;
    private $paymentVerificationServices;


    public function __construct(UserService $userService,
                                CompanyService $companyService,
                                WalletService $walletService,
                                PaymentVerificationServices $paymentVerificationServices)
    {
        $this->userService = $userService;
        $this->companyService = $companyService;
        $this->walletService = $walletService;
        $this->paymentVerificationServices= $paymentVerificationServices;
    }

    public function dashboard()
    {
        $user = Auth::guard('web')->user();
        $user->billing_details = $user->billinginfo;
        $user->shipment_details = $user->shipmentInfo;
        return view('frontend.user.dashboard', compact('user'));
    }

    public function userInfo()
    {
        $user = Auth::guard('web')->user();
        return view('frontend.user.my-account.user-info', compact('user'));
    }

    public function editUserInfo()
    {
        $user = Auth::guard('web')->user();
        return view('frontend.user.my-account.user-info-edit', compact('user'));
    }

    public function sellerInfo()
    {
        $user = Auth::guard('web')->user();
        $seller = $user->seller;

        return view('user.my-account.seller-info', compact('seller', 'user'));
    }

    public function editSellerInfo()
    {
        $user = Auth::guard('web')->user();
        $seller = $user->seller;

        return view('user.my-account.seller-info-edit', compact('seller', 'user'));
    }

    public function changePassword()
    {
        return view('user.my-account.change-password');
    }

    public function accountSettings()
    {
        $user = Auth::guard('web')->user();

        return view('user.my-account.settings.' . auth()->user()->role, compact('user'));
    }

    // UpdateUserInfoRequest
    public function updateUserInfo(Request $request)
    {
        $data = $request->all();

        $this->userService->updateUserInfo($data);

        return redirect('/user/my-account/user-info');
    }
    public function getUpdatePassword()
    {
        return view('frontend.user.my-account.update-password');
    }
    // UpdateUserPasswordRequest
    public function updatePassword(UpdateUserPasswordRequest $request)
    {

        $password = $request->password;
        $this->userService->updatePassword($password);
        flash('successfully updated')->success();
        return redirect('/user/my-account/user-info');
    }

    public function updateSellerInfo(UpdateSellerInfoRequest $request)
    {
        $data = $request->except('_method', 'seller', '_token');

        $data = array_merge($data, $request->get('seller'));

        $this->userService->updateSellerInfo($data);

        return redirect('/user/my-account/seller-info');
    }

    public function updateCompanyInfo(UpdateCompanyInfoRequest $request)
    {
        $data = $request->all();

        $this->userService->updateCompanyInfo($data);

        return redirect('/user/my-account/company-info');
    }

    public function createSellerCompany()
    {
        return view('user.create-seller-company');
    }

    public function storeSellerCompany(CreateSellerCompanyRequest $request)
    {
        $data = $request->all();

        $this->userService->createSellerCompany($data, $request->government_business_permit);

        return redirect('/user');
    }

    public function closeCompany(CloseCompanyRequest $request)
    {
        $companyId = auth()->user()->seller->company_id;

        $this->companyService->delete($companyId, false, $request->company_reason);

        return redirect('user');
    }

    public function closeSellerAccount(CloseSellerAccountRequest $request)
    {
        $sellerId = auth()->user()->id;

        $this->userService->deleteAssociateSeller($sellerId, false, $request->get('seller_reason'));

        return redirect('user');
    }

    public function closeUserAccount(CloseUserAccountRequest $request)
    {
        $userId = auth()->user()->id;

        $this->userService->deleteUserAccount($userId, false, $request->get('user_reason'));

        auth()->logout();

        return back();
    }
// UploadProfilePicRequest
    public function uploadProfilePic(UploadProfilePicRequest $request)
    {
        $path = $request->profile_pic->store('public/profile-pics');

        $user = Auth::guard('web')->user();

        $user->profile_pic = $path;
        $modificationDetails = ["zoom" => "0", "position" => ["x" => "0", "y" => "0"]];
        $user->profile_pic_position = $modificationDetails;

        $user->save();

        $croppedPath = (new \Modules\Utilities\NewCropImage(storage_app_path($path), [User::DEFAULT_PROFILE_PIC_SIZE, User::DEFAULT_PROFILE_PIC_SIZE]))->resize()->crop()->save();
        if ($request->ajax()) {
            return ['path' => map_storage_path_to_link($croppedPath), 'modification_details' => $modificationDetails];
        } else {
            Session('success', 'Successfully Updated');
            return redirect()->back();
        }
    }

    public function removeProfilePic()
    {
        $user = Auth::guard('web')->user();

        $user->profile_pic = null;
        $user->profile_pic_position = ["zoom" => "0", "position" => ["x" => "0", "y" => "0"]];

        $user->save();

        return back();
    }

    public function rePositionProfilePic(RepositionProfilePicRequest $request)
    {
        $data = $request->all();
        $user = Auth::guard('web')->user();

        $user->profile_pic_position = $request->only('position_x', 'position_y');

        $user->save();

        (new \Modules\Utilities\CropImage(storage_app_path($user->profile_pic), [parsePosition($data['position_x']), parsePosition($data['position_y'])], [100, 100]))->crop()->save();

        return back();
    }

    public function base64UploadImage(UploadBase64ImageRequest $request)
    {
        $user = Auth::guard('web')->user();

        $pieces = explode('/', storage_app_path($user->profile_pic));
        $pieces[count($pieces) - 1] = 'cropped_' . $pieces[count($pieces) - 1];

        ImageManagerStatic::make($request->base64_image_data)->save(implode('/', $pieces));

        $modificationDetails = $request->get('modification_details');
        $modificationDetails['zoom'] = $modificationDetails['zoom'] == 'NaN' ? "0" : $modificationDetails['zoom'];
        $modificationDetails['position']['x'] = $modificationDetails['position']['x'] == 'NaN' ? "0" : $modificationDetails['position']['x'];
        $modificationDetails['position']['y'] = $modificationDetails['position']['y'] == 'NaN' ? "0" : $modificationDetails['position']['y'];

        $user->profile_pic_position = $modificationDetails;

        $user->save();

        return $request->modification_details;
    }

    public function shipmentInfo()
    {
        $user = Auth::guard('web')->user();

        return view('frontend.user.my-account.shipment-info', compact('user'));
    }

    public function editShipmentInfo()
    {
        $user = Auth::guard('web')->user();
        $user->shipment_details = json_encode($user->shipment_details, true);
        return view('frontend.user.my-account.shipment-info-edit', compact('user'));
    }

    public function updateShipmentInfo(UpdateShipmentInfoRequest $request)
    {
        try{
            $user = Auth::guard('web')->user();
            $data = $request->only([
                'state',
                'city',
                'specific_address',
                'country',
                'phone_number',
            ]);
            // $user->shipment_details = json_encode($data);
            $user->shipment_details = $data;
            $user->save();
        }catch (\PDOException $exception){
            flash('successfully updated')->success();
            return redirect()->back();
        }
        flash('successfully updated')->success();
        return redirect()->back();

    }

    public function billingInfo()
    {
        $user = Auth::guard('web')->user();
        return view('frontend.user.my-account.billing-info', compact('user'));
    }
    public function editBillingInfo()
    {
        $user = Auth::guard('web')->user();
        // $user->billing_details = json_decode($user->billing_details, true);

        return view('frontend.user.my-account.billing-info-edit', compact('user'));
    }

    public function updateBillingInfo(UpdateBillingInfoRequest $request)
    {
        $user = Auth::guard('web')->user();
        $data = $request->only([
            'state',
            'city',
            'specific_address',
            'country',
            'phone_number',
        ]);
        $user->billing_details = $data;
        $user->save();
        session()->flash('message', 'successfully updated');
        return redirect()->back();
    }

    // wallet

    public function wallet()
    {
        $data = [
            'pid' => null,
            'user_id' => auth('web')->user()->id,
        ];
        $pid = $this->paymentVerificationServices->store_esewa_verifcation($data);
        $user = Auth::guard('web')->user();
        $transactions = $this->walletService->getAllByUserId($user->id);
        return view('frontend.user.my-account.wallet')->with('transactions', $transactions)->with('pid',$pid);
    }

    public function loadWallet(WalletRequest $request)
    {
        try {
            $user = Auth::guard('web')->user();
            $data = $request->all();
            $data['user_id'] = $user->id;
            if ($data['payment_method'] == 'esewa') {
                // $data['description'] = 'Balance loaded successfully from esewa';
                $data['description'] = ' loaded successfully';
            } elseif ($data['payment_method'] == 'khalti') {
                // $data['description'] = 'Balance loaded successfully from khalti';
                $data['description'] = 'loaded successfully';
            }
            $data['transaction_type'] = 'credit';
            $data['status'] = true;

            $this->walletService->create($data);
            Session()->flash('success', 'Balance loaded successfully');
            return redirect()->route('user.my-account.wallet');
        } catch (\Throwable $th) {
            Session()->flash('error', 'Balance could not be loaded');
            Session()->flash('error', $th->getMessage());
        } catch (Exception $ex) {
            Session()->flash('error', $ex->getMessage());

        }
    }
}
