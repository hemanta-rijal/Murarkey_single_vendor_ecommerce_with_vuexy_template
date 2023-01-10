<?php

namespace App\Http\Controllers\API\V1;
use App\Http\Controllers\Controller;
use App\Http\Resources\Wallet\WalletResource;
use Modules\PaymentVerification\Services\PaymentVerificationServices;
use Illuminate\Http\Request;
use Modules\Users\Contracts\UserRepository;
use Modules\Users\Contracts\UserService;
use Modules\Wallet\Services\WalletService;
class WalletController extends Controller
{
    protected $userService, $userRepository, $walletService,$paymentVerificationServices;

    public function __construct(UserService $userService, UserRepository $userRepository, WalletService $walletService,PaymentVerificationServices $paymentVerificationServices)
    {
        $this->walletService = $walletService;
        $this->userService = $userService;
        $this->paymentVerificationServices = $paymentVerificationServices;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $user = $this->userService->getLogedInUser();
        $transactions = $this->walletService->getAllByUserId($user->id);
        return WalletResource::collection($transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function VerifyEsewa(Request $request){
        if ($request->q == "su") {
            $response = $this->paymentVerificationServices->verifyEsewa($request->amt,$request,$this->userService->getLogedInUser());
            if ($response == true) {
                $request->session()->regenerate();
                $request = $this->walletService->setWalletRequest($this->userService->getLogedInUser()->id, $request->amt, 'esewa', 'credit', ' loaded successfully', true);
                $this->walletService->create($request);
                return redirect()->json(['data'=>'','message'=>'wallet loaded successfully']);
            }
        }
    }
}
