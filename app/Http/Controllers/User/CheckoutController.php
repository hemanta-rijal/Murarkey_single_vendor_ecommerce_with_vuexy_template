<?php

namespace App\Http\Controllers\User;

use App\Events\BoughtFromDiscount;
use App\Events\CheckoutFromCartEvent;
use App\Http\Controllers\Controller;
use App\Modules\Cart\Requests\CheckoutRequest;
use App\Modules\PaymentVerification\Services\PaymentVerificationServices;
use App\Traits\SubscriptionDiscountTrait;
use Cart;
use Illuminate\Http\Request;
use Modules\Cart\Services\CartService;
use Modules\Orders\Contracts\OrderService;
use Modules\Products\Contracts\ProductService;

class CheckoutController extends Controller
{
    use SubscriptionDiscountTrait;

    private $productService;

    private $orderService;
    private $paymentVerificationService;
    private $cartServices;

    public function __construct(ProductService $productService,
                                OrderService $orderService,
                                PaymentVerificationServices $paymentVerificationServices,
                                CartService $cartService)
    {
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->cartServices = $cartService;
        $this->paymentVerificationService = $paymentVerificationServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $items = Cart::content();
            $tax = Cart::tax();
            $subTotal = Cart::subTotal();


        if ($items->sum('qty') == 0)
            return redirect('/');

        $total = 0;

        foreach ($items as $item) {
            if ($item->doDiscount)
                //TODO:: check price
                $total += ceil($item->price * 0.5) + ceil($item->price * 0.13);
            else
                $total += $item->price * $item->qty;
    }

        $user = auth('web')->user();

        return view('frontend.user.checkout', compact('items', 'total', 'subTotal', 'tax', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $carts = $this->cartServices->getCartByUser(auth('web')->user());
        if($request->payment_method =='esewa'){
            $this->paymentVerificationService->paymentEsewa($carts);
        }
//        $items = $this->processItems($items);

//        $this->orderService->add(auth()->user(), $items, $request->get('user'), $request->get('payment_method'));


//        if (!session()->has('buy_now'))
//            event(new CheckoutFromCartEvent(auth()->user()));
//
//
//        session()->flash('order_placed', true);
//
//        $user = auth()->user();
//
//        $user->sms_verify_token = '';
//
//        $user->save();
//
//        return redirect()->route('user.my-orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }






}
