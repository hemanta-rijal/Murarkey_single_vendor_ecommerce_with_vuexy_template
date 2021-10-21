<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Modules\PaymentVerification\Services\PaymentVerificationServices;
use App\Traits\SubscriptionDiscountTrait;
use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Contracts\CartService;
use Modules\Orders\Contracts\OrderService;
use Modules\Wallet\Services\WalletService;

class PaymentVerificationController extends Controller
{
    use SubscriptionDiscountTrait;
    private $cartService;
    private $paymentVerificationServices;
    private $orderService;
    private $walletService;
    public $user;
    public function __construct(CartService $cartService,
        PaymentVerificationServices $paymentVerificationServices,
        OrderService $orderService,
        WalletService $walletService) {
        $this->cartService = $cartService;
        $this->paymentVerificationServices = $paymentVerificationServices;
        $this->orderService = $orderService;
        $this->walletService = $walletService;
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
                        $this->makeOrder('esewa');
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
    public function makeOrder($paymentMethod)
    {
        $carts = $this->cartService->getCartByUser($this->user);
        $items = $this->processItems($carts['content']);
        $this->orderService->add($this->user, $items, $paymentMethod);
        session()->flash('Order Placed Successfully', true);
    }

    public function storeEsewaPid(Request $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
        ];
        return response()->json(['data' => ['pid' => $this->paymentVerificationServices->store_esewa_verifcation($data)], 'success' => true, 'status' => 200, 'message' => 'esewa pid stored and returned successfully']);
    }
}
