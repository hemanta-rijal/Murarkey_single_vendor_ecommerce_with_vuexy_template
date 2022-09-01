<?php

namespace App\Http\Controllers\API\V1;

use App\Events\CheckoutFromCartEvent;
use App\Models\Product;
use App\Models\Service;
use App\Modules\Cart\Requests\CheckoutFromBuyNowRequest;
use App\Modules\Cart\Requests\CheckoutRequest;
use App\Traits\SubscriptionDiscountTrait;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\Request;
use Modules\Cart\Contracts\CartService;
use Modules\Coupon\Services\CouponService;
use Modules\Orders\Contracts\OrderService;
use Modules\PaymentVerification\Services\PaymentVerificationServices;
use Modules\Products\Contracts\ProductService;
use Cart;
use Modules\Users\Services\UserService;

/**
 * Class CheckoutController
 * @package App\Http\Controllers\API\V1
 */
class CheckoutController extends BaseController
{
    use SubscriptionDiscountTrait;

    private $productService;

    private $orderService;

    private $cartService;
    private $paymentVerificationService;
    private $userService;
    private $couponService;

    public function __construct(ProductService $productService,
                                OrderService $orderService,
                                CartService $cartService,
                                PaymentVerificationServices $paymentVerificationService,
                                UserService $userService,
                                CouponService $couponService)
    {
        $this->productService = $productService;

        $this->orderService = $orderService;

        $this->cartService = $cartService;

        $this->paymentVerificationService = $paymentVerificationService;

        $this->userService = $userService;

        $this->couponService = $couponService;
    }

    public function index(){
        $user= $this->userService->getLogedInUser();
        $cart = $this->cartService->getCartByUser($user);
        $items = $cart['content'];
        $tax = 0;
        $subTotal = 0;
        $couponDetail = '';
        $couponDiscountPrice = 0;
        $couponAppliedRowId = [];

        $pid = $this->paymentVerificationService->get_esewa_pid($user->id);
        foreach ($items as $item) {
            //checking the cart is either product or service
            $product = $item->associatedModel == 'App\Models\Product'? Product::find($item->id) : Service::find($item->id);
            // different tax rate in product and services
            $tax_rate = $item->associatedModel == 'App\Models\Product'? get_meta_by_key('custom_tax_on_product') : get_meta_by_key('custom_tax_on_service');

            $priceWithoutTax = $product->tax_option ? $product->priceAfterReverseTaxCalculation($item->price, $tax_rate) : $item->price;
            $subTotal += $priceWithoutTax*$item->qty;
            print_r(session()->has('coupon'));
            exit();
            if (session()->has('coupon') && $this->couponService->couponApplicable($item)) {
                array_push($couponAppliedRowId,$item->rowId);
                $couponDetail = session()->get('coupon');
                $couponDiscountDetailOnItem = $this->couponService->couponApply($priceWithoutTax, $couponDetail['discount_type'], $couponDetail['discount']);
                $couponDiscountPrice+= $couponDiscountDetailOnItem['discount'];
                $priceWithoutTax = $couponDiscountDetailOnItem['price'];
                $tax += $product->getTaxAmountWhichExcludeTax($priceWithoutTax, $tax_rate)*$item->qty;
            }else{
                $tax+= $product->tax_option ? $product->getTaxAmountAfterReverseTaxCalculation($item->price,$tax_rate)*$item->qty : $product->getTaxAmountWhichExcludeTax($priceWithoutTax,$tax_rate)*$item->qty;
            }
        }
        //put checkout data on session
        session()->put('checkout', [
            'content' => $items,
            'subtotal' => round($subTotal, 2),
            'couponDetail' => $couponDetail!=null ? $couponDetail : [],
            'couponDiscountPrice'=>$couponDiscountPrice!=0 ? $couponDiscountPrice:null,
            'tax' => round($tax, 2),
            'total' => round($subTotal -$couponDiscountPrice+ $tax, 2)
        ]);
        return response()->json(['data'=>session()->get('checkout')]);
    }

    public function checkoutFromCart(CheckoutRequest $request)
    {
        $items = $this->cartService->getCartByUser($this->auth->user());

        $this->orderService->add($this->auth->user(), $items, $request->get('user'), $request->get('payment_method'));

        event(new CheckoutFromCartEvent(auth()->user()));

        return ['status' => 'ok'];
    }

    public function checkoutFromBuyNow(CheckoutFromBuyNowRequest $request)
    {
        $options = isset($request->get('item')['options']) ? $request->get('item')['options'] : [];
        $product = $this->productService->findById($request->get('item')['product_id']);
        $item = CartItem::fromBuyable($product, $options);
        $item->setQuantity($request->get('item')['qty']);
        $item->associate($product);
        $items = collect([$item]);
        $this->orderService->add($this->auth->user(), $items, $request->get('user'), $request->get('payment_method'));

        return ['status' => 'ok'];
    }

    public function paypalPayment(Request $request)
    {
        return response()->json(
            [
                'data' => [
                    'paymet_method_nonce' => $request->paymet_method_nonce,
                    'divice_data' => $request->divice_data,
                ],
                'success' => true,
                'message' => 'payment from paypal is succeed',
                'status' => 200,
            ]
        );
    }

    public function applyCoupon(Request $request){
        $coupon = $this->couponService->getByCode($request->code);
        if ($coupon) {
            if ($coupon->isActive) {
                //remove all old coupon session
                session()->forget('coupon');
                //create a new coupon session
                session()->put('coupon', [
                    'coupon' => $coupon->coupon,
                    'coupon_for' => $coupon->couponDetail,
                    'discount_type' => $coupon->discount_type,
                    'discount' => $coupon->discount
                ]);
                return response()->json(['data'=>'','message'=>'coupon applied successfully','status'=>true],200);
            } else {
                return response()->json(['data'=>'','message'=>'Coupon cannot available, Coupon may be unavailable or expired!','status'=>false],200);
            }
        } else {
            return response()->json(['data'=>'','message'=>'Coupon cannot available, Coupon may be unavailable or expired!','status'=>false],200);

        }
    }
}
