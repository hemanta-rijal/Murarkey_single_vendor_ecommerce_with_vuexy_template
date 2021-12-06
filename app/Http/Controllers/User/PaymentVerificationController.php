<?php

namespace App\Http\Controllers\User;

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

    public function __construct(CartService $cartService,
        PaymentVerificationServices $paymentVerificationServices,
        OrderService $orderService,
        WalletService $walletService) {
        $this->cartService = $cartService;
        $this->paymentVerificationServices = $paymentVerificationServices;
        $this->orderService = $orderService;
        $this->walletService = $walletService;
    }

    public function loadPayWithEsewaOption(Request $request)
    {
        $data = [
            'pid' => $request->pid,
            'user_id' => auth('web')->user()->id,
        ];
        $this->paymentVerificationServices->store_esewa_verifcation($data); //storing esewa pid while going through checkout process
        $routeUrl = returnRouteUrl($request->payment_type);
        if ($request->amount != null && $request->payment_type == "wallet") {
            $amount = $request->amount;
        } else {
            $carts = getCartForUser();
            $amount = $carts['total'];
        }
        return view('frontend.partials.esewaPaymentOption')->with('url', $routeUrl)->with('amount', $amount)->with('pid', $request->pid);
    }

    public function eSewaVerifyForProduct(Request $request)
    {
        if ($request->q == "su") {
            try {
                DB::transaction(function () use ($request) {
                    $pid = $request->oid;
                    $carts = $this->cartService->getCartByUser(auth('web')->user());
                    $total_amount = (int) str_replace(',', '', $carts['total']);
                    $response = $this->paymentVerificationServices->verifyEsewa($total_amount, $request, auth('web')->user());
                    if ($response == true) {
                        $request->session()->regenerate();
                        $this->makeOrder('esewa', $request->date, $request->time);
                    }
                });
            } catch (\PDOException $exception) {
                return $exception->getMessage();
            } catch (Exception $exception) {
                return $exception->getMessage();
            }
            return redirect()->route('user.my-orders.index');
        }
        return "Order Cancelled";
    }

    public function walletVerifyForProduct(Request $request)
    {
        $carts = $this->cartService->getCartByUser(auth('web')->user());
        $walletAmount = $this->walletService->getWalletAmountByUser(auth('web')->user());
        if ($walletAmount > $carts['total']) {
            return response()->json(['data' => '', 'status' => true, 'message' => 'Wallet Payment is Available']);
        }
        return response()->json(['data' => '', 'status' => false, 'message' => 'You don\'t have enough amount in your Wallet']);
    }

    public function walletVerifyEsewa(Request $request)
    {
        if ($request->q == "su") {
            $response = $this->paymentVerificationServices->verifyEsewa($request->amt, $request);
            if ($response == true) {
                $request->session()->regenerate();
                $request = $this->walletService->setWalletRequest(auth('web')->user()->id, $request->amt, 'esewa', 'credit', ' loaded successfully', true);
                $this->walletService->create($request);
                return redirect()->to('user/my-account/wallet');
            }
        }

    }

    public function walletVerifyPaypal(Request $request)
    {
        // TODO:
        //we can restrict for user whose supported currency is not aud or international
        return response()->json(['data' => '', 'status' => true, 'message' => 'Paypal Payment is Available']);
        // return response()->json(['data' => '', 'status' => false, 'message' => 'You don\'t have enough amount in your Wallet']);

    }

    public function makeOrder($paymentMethod, $date, $time)
    {
        $carts = $this->cartService->getCartByUser(auth('web')->user());
        $items = $this->processItems($carts['content']);
        $this->orderService->add(auth('web')->user(), $items, $paymentMethod, $date, $time);
        //cashback code
        if (getCashBack($items) > 0) {
            $this->walletService->create($this->walletService->setWalletRequest(auth('web')->user()->id, getCashBack($items), '', 'credit', 'cashback reward', true));
        }
        foreach ($items as $item) {
            $this->cartService->delete(auth('web')->user(), $item->rowId);
        }

        Session()->flash('success', 'Order placed successfully');
        return redirect()->route('user.my-orders.index');
    }
}
