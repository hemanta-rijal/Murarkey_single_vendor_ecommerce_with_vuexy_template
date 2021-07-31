<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Modules\PaymentVerification\Services\PaymentVerificationServices;
use App\Traits\SubscriptionDiscountTrait;
use Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Services\CartService;
use Modules\Orders\Contracts\OrderService;
use Modules\Products\Contracts\ProductService;
use Modules\Wallet\Services\WalletService;
use Srmklive\PayPal\Services\ExpressCheckout;

class CheckoutController extends Controller
{
    use SubscriptionDiscountTrait;

    private $productService;

    private $orderService;
    private $paymentVerificationService;
    private $cartServices;
    private $walletServices;

    public function __construct(
        ProductService $productService,
        OrderService $orderService,
        WalletService $walletService,
        PaymentVerificationServices $paymentVerificationServices,
        CartService $cartService) {
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->cartServices = $cartService;
        $this->walletServices = $walletService;
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

        if ($items->sum('qty') == 0) {
            return redirect('/');
        }

        $total = 0;

        foreach ($items as $item) {
            //TODO:: check price
            if ($item->doDiscount) {
                $total += ceil($item->price * 0.5) + ceil($item->price * 0.13);
            } else {
                $total += $item->price * $item->qty;
            }

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
        $total_amount = $carts['total'];
        $items = $this->processItems($carts['content']);

        if ($request->payment_method == 'wallet') {
            if ($this->walletServices->checkTransactionPayable(auth('web')->user(), $total_amount)) {
                try {
                    DB::transaction(function () use ($user, $carts, $total_amount, $items) {
                        $order = $this->orderService->add($user, $carts['content'], 'wallet');
                        $this->walletServices->create($this->walletServices->setWalletRequest($user->id, $total_amount, '', 'debit', 'order purchased', true));
                        //cashback
                        if (getCashBack($items) > 0) {
                            $this->walletServices->create($this->walletServices->setWalletRequest($user->id, getCashBack($items), '', 'credit', 'cashback reward', true));
                        }
                        foreach ($items as $item) {
                            $this->cartServices->delete($user, $item->rowId);
                        }
                    });
                } catch (\PDOException $exception) {
                    Session()->flash('error', 'order cannot placed');
                    // dd($exception->getMessage());
                    return redirect()->route('user.my-orders.index');
                } catch (Exception $ex) {
                    Session()->flash('error', $ex->getMessage());
                    return redirect()->route('user.my-orders.index');
                }
                Session()->flash('success', 'Order placed successfully');
                return redirect()->route('user.my-orders.index');
            }
        } elseif ($request->payment_method == 'paypal') {
            try {

                DB::transaction(function () use ($user, $carts, $total_amount, $items) {
                    $this->orderService->add($user, $carts['content'], 'paypal');
                    // $this->walletServices->create($this->walletServices->setWalletRequest($user->id, $total_amount, '', 'debit', 'order placed', true));
                    foreach ($items as $item) {
                        //To do: cashback
                        $this->cartServices->delete($user, $item->rowId);
                    }
                    $this->payment($items->toArray(), $total_amount);
                });
            } catch (\PDOException $exception) {
                Session()->flash('error', 'order cannot placed');
                // dd($exception->getMessage());
                return redirect()->route('user.my-orders.index');
            } catch (Exception $ex) {
                Session()->flash('error', $ex->getMessage());
                return redirect()->route('user.my-orders.index');
            }
            Session()->flash('success', 'Order placed successfully');
            return redirect()->route('user.my-orders.index');

            return redirect()->route('payment');
        }

    }

    public function payment($items, $total_amount)
    {
        // dd($items);

        $data = [];
        $data['items'] = $items;

        //array format must be following
        // $data['items'] = [
        //     [
        //         'name' => 'codechief.org',
        //         'price' => 100,
        //         'desc' => 'Description goes herem',
        //         'qty' => 1,
        //     ],
        // ];

        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $total_amount;

        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data, true);
        dd($response['paypal_link']);
        dd($provider, $response);
        return redirect($response['paypal_link']);
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
