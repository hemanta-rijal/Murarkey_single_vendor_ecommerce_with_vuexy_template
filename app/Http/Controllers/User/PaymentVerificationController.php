<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Modules\PaymentVerification\Services\PaymentVerificationServices;
use App\Traits\SubscriptionDiscountTrait;
use Dompdf\Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
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
        $data['pid'] =$this->paymentVerificationServices->store_esewa_verifcation($data); //storing esewa pid while going through checkout process
        $routeUrl = returnRouteUrl($request->payment_type);
        //for wallet
        if ($request->amount != null && $request->payment_type == "wallet") {
            $amount = $request->amount;
        } else {
            $checkout = getCheckoutSession();
            $amount = $checkout['total'];
        }
        return view('frontend.partials.esewaPaymentOption')->with('url', $routeUrl)->with('amount', $amount)->with('pid', $data['pid']);
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
                        $order = $this->makeOrder('esewa', $request->date, $request->time);
                        if(!$order){
                            flash('success','order Cannot stored');
                            return redirect()->route('user.my-orders.index');
                        }
                        Cart::destroy();
                        DB::table('shopping_cart')->where('identifier',auth('web')->user()->id)->delete();
                    }
                });
            } catch (\PDOException $exception) {
                return $exception->getMessage();
            } catch (Exception $exception) {
                return $exception->getMessage();
            }
            return redirect()->route('user.my-orders.index');
        }
        flash('success','order Cannot stored');
        return redirect()->route('user.my-orders.index');
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
        $checkout = getCheckoutSession();
        $items = $this->processItems($checkout['items']);
        if($this->orderService->add(auth('web')->user(), $items, $paymentMethod, $date, $time)){
            //cashback code
            if (getCashBack($items) > 0) {
                $this->walletService->create($this->walletService->setWalletRequest(auth('web')->user()->id, getCashBack($items), '', 'credit', 'cashback reward', true));
            }
            foreach ($items as $item) {
                $this->cartService->delete(auth('web')->user(), $item->rowId); // un/comment later
            }
            return true;
        }
        flushCheckoutSession();
        return false;
    }
}
