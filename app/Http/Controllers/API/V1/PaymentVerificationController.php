<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Modules\PaymentVerification\Services\PaymentVerificationServices;
use App\Traits\SubscriptionDiscountTrait;
use Dompdf\Exception;
use Illuminate\Http\Request;
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
    public function __construct(CartService $cartService,
        PaymentVerificationServices $paymentVerificationServices,
        OrderService $orderService,
        WalletService $walletService) {
        $this->cartService = $cartService;
        $this->paymentVerificationServices = $paymentVerificationServices;
        $this->orderService = $orderService;
        $this->walletService = $walletService;
    }
    public function eSewaVerifyForProduct(Request $request)
    {
        if ($request->q == "su") {
            try {
                DB::transaction(function () use ($request) {
                    $pid = $request->oid;
                    $carts = $this->cartService->getCartByUser(auth()->user());
                    $total_amount = (int) str_replace(',', '', $carts['total']);
                    $response = $this->paymentVerificationServices->verifyEsewa($total_amount, $request);
                    if ($response == true) {
                        $request->session()->regenerate();
                        $this->makeOrder('esewa');
                    }
                });
            } catch (\PDOException $exception) {
                $request->session()->regenerate();
                return $exception->getMessage();
            } catch (Exception $exception) {
                $request->session()->regenerate();
                return $exception->getMessage();
            }
            return response()->json(['data' => [], 'message' => 'order successfully']);
        }
        return "Order Cancelled";
    }
    public function makeOrder($paymentMethod)
    {
        $carts = $this->cartService->getCartByUser(auth()->user());
        $items = $this->processItems($carts['content']);
        $this->orderService->add(auth()->user(), $items, $paymentMethod);
        session()->flash('Order Placed Successfully', true);
    }
}
