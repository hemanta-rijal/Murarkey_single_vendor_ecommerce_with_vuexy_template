<?php

namespace App\Http\Controllers\User;

use App\Events\CheckoutFromCartEvent;
use App\Http\Controllers\Admin\ThemeSettingController;
use App\Http\Controllers\Controller;
use App\Modules\PaymentVerification\Services\PaymentVerificationServices;
use App\Traits\SubscriptionDiscountTrait;
use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Contracts\CartService;
use Modules\Orders\Contracts\OrderService;

class PaymentVerificationController extends Controller
{
    use SubscriptionDiscountTrait;
    private $cartService;
    private $paymentVerificationServices;
    private $orderService;
    public function __construct(CartService $cartService,PaymentVerificationServices $paymentVerificationServices,OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->paymentVerificationServices = $paymentVerificationServices;
        $this->orderService = $orderService;
    }

    public function loadPayWithEsewaOption(Request $request){
        return view('frontend.partials.cart.esewaPaymentOption');
    }
    public function eSewaVerify(Request $request){
        if($request->q =="su"){
            try{
                DB::transaction(function ()use($request){
                    $pid = $request->oid;
                    $carts = $this->cartService->getCartByUser(auth('web')->user());
                    $response = $this->paymentVerificationServices->verifyEsewa($carts,$request);
                    if($response==true){
                        $request->session()->regenerate();
//                        dd("paid");
                        $this->makeOrder('esewa',$pid);
                    }
                });
            }catch (\PDOException $exception) {
                $request->session()->regenerate();
                return $exception->getMessage();
//                dd($exception->getMessage());
            }catch (Exception $exception){
                $request->session()->regenerate();
                return $exception->getMessage();
            }
            return redirect()->route('user.my-orders.index');
        }
//        dd(session()->getId());
        return "Order Cancelled";
    }
    public function makeOrder($paymentMethod,$referenceCode=null){
        $carts = $this->cartService->getCartByUser(auth('web')->user());
        $items = $this->processItems($carts['content']);
        $this->orderService->add(auth('web')->user(), $items, $paymentMethod,$referenceCode);
        session()->flash('Order Placed Successfully', true);
    }
}
