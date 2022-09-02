<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Modules\PaymentVerification\Services\PaymentVerificationServices;
use App\Traits\SubscriptionDiscountTrait;
use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Contracts\CartService;
use Modules\Orders\Contracts\OrderService;
use Modules\Users\Services\UserService;
use Modules\Wallet\Services\WalletService;

class PaymentVerificationController extends Controller
{
    use SubscriptionDiscountTrait;
    private $cartService;
    private $paymentVerificationServices;
    private $orderService;
    private $walletService;
    public $user;
    private $userService;
    public function __construct(CartService $cartService,
        PaymentVerificationServices $paymentVerificationServices,
        OrderService $orderService,
        WalletService $walletService,
        UserService $userService) {
        $this->cartService = $cartService;
        $this->paymentVerificationServices = $paymentVerificationServices;
        $this->orderService = $orderService;
        $this->walletService = $walletService;
        $this->userService = $userService;
        $this->user = Auth::user();
    }
    public function eSewaVerifyForProduct(Request $request)
    {
        if ($request->q == "su") {
            try {
                DB::transaction(function () use ($request) {
                    $pid = $request->oid;
                    $user = $this->paymentVerificationServices->get_user_by_pid($pid);
                    $carts = $this->cartService->getCartByUser($user);
                    $total_amount = (int) str_replace(',', '', $carts['total']);
                    $response = $this->paymentVerificationServices->verifyEsewa($total_amount, $request,$user);
                    if ($response == true) {
                        $this->makeOrder('esewa',$user);
                    }
                });
            } catch (\PDOException $exception) {
                return $exception->getMessage();
            } catch (Exception $exception) {
                return $exception->getMessage();
            }
            return response()->json(['data' => [], 'message' => 'order successfully']);
        }
        return "Order Cancelled";
    }
    public function makeOrder($paymentMethod,$user)
    {
        $carts = $this->cartService->getCartByUser($user);
        $items = $this->processItems($carts['content']);
        $this->orderService->add($user, $items, $paymentMethod);
        session()->flash('Order Placed Successfully', true);
    }

    public function storeEsewaPid(Request $request)
    {
        $data = [
            'user_id' => $this->userService->getLogedInUser()->id,
        ];
        return response()->json(['data' => ['pid' => $this->paymentVerificationServices->store_esewa_verifcation($data)], 'success' => true, 'status' => 200, 'message' => 'esewa pid stored and returned successfully']);
    }
}
