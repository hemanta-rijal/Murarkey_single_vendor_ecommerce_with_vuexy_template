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
use Illuminate\Support\Facades\DB;
use Modules\Cart\Services\CartService;
use Modules\Orders\Contracts\OrderService;
use Modules\Products\Contracts\ProductService;
use Modules\Wallet\Services\WalletService;

class CheckoutController extends Controller
{
    use SubscriptionDiscountTrait;

    private $productService;

    private $orderService;
    private $paymentVerificationService;
    private $cartServices;
    private $walletServices;

    public function __construct(ProductService $productService,
                                OrderService $orderService,
                                WalletService $walletService,
                                PaymentVerificationServices $paymentVerificationServices,
                                CartService $cartService)
    {
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->cartServices = $cartService;
        $this->walletServices= $walletService;
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
        $user = auth('web')->user();
        $carts = $this->cartServices->getCartByUser(auth('web')->user());
        dd($carts);
        if($request->payment_method =='wallet'){
            $total_amount = $carts['total'];
            $items = $this->processItems($carts['content']);
            if($this->walletServices->checkTransactionPayable(auth('web')->user(),$total_amount)){
                try{
                    DB::transaction(function ()use($user,$carts,$total_amount){
                        $this->orderService->add($user,$carts['content'],'wallet');
                        $this->walletServices->create($this->walletServices->setWalletRequest($user->id,$total_amount,'','debit','order',true));
                    });
                }catch (\PDOException $exception){
                    session()->flash('order cannot placed', true);
                    dd($exception->getMessage());
                }
                session()->flash('order_placed', true);
                return redirect()->route('user.my-orders.index');
            }
        }

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
