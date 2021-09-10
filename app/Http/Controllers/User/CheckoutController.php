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
        $items = $this->processItems($carts['content']);
        $total_amount = $carts['total'];
        $date = $request->date;
        $time = $request->time;

        if ($request->payment_method == 'wallet') {
            if ($this->walletServices->checkTransactionPayable(auth('web')->user(), $total_amount)) {
                try {
                    DB::transaction(function () use ($user, $carts, $total_amount, $items, $date, $time) {
                        $order = $this->orderService->add($user, $carts['content'], 'wallet', $date, $time);
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

            $paypal_link = null;
            try {

                // DB::transaction(function ($paypal_link) use ($user, $carts, $total_amount, $items) {
                $this->orderService->add($user, $carts['content'], 'paypal', $date, $time);
                foreach ($items as $item) {
                    //To do: cashback
                    $item->price = number_format((float) convertCurrency($item->price), 2, '.', '');
                }
                $paypal_link = $this->payment($carts, $items, $total_amount);
                // dd($paypal_link);

                // });
            } catch (\PDOException $exception) {
                Session()->flash('error', 'order cannot placed');
                return redirect()->route('user.my-orders.index');
            } catch (Exception $ex) {
                Session()->flash('error', $ex->getMessage());
                return redirect()->route('user.my-orders.index');
            } catch (\Throwable $th) {
                Session()->flash('error', $th->getMessage());
                return redirect()->route('user.my-orders.index');
            }

            if ($paypal_link != null) {
                return redirect()->away($paypal_link);
            }

            Session()->flash('error', 'Problems Occoured, Please Try Later');
            return redirect()->back();
        }

    }

    public function payment($carts, $items, $total_amount)
    {
        // dd($items);

        $data = [];
        $data['items'] = $items->toArray();

        $data['invoice_id'] = uniqid();
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['tax'] = number_format((float) convertCurrency($carts['tax']), 2, '.', '');
        $data['subtotal'] = number_format((float) convertCurrency($carts['subTotal']), 2, '.', '');
        $data['shipping'] = number_format((float) convertCurrency($carts['shippingAmount']), 2, '.', '');
        $data['total'] = number_format((float) convertCurrency($carts['total']), 2, '.', '');

        //temp soln:
        $data['subtotal'] += $data['total'] - ($data['tax'] + $data['subtotal'] + $data['shipping']);
        $data['subtotal'] = number_format((float) $data['subtotal'], 2, '.', '');

        // dd($data);
        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
        // dd($response);
        return $response['paypal_link'];
    }

    public function cancel()
    {
        Session()->flash('error', 'Order could not be place');
        return redirect()->route('user.my-orders.index');

    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $provider = new ExpressCheckout;

        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            $carts = $this->cartServices->getCartByUser(auth('web')->user());
            $items = $this->processItems($carts['content']);

            //delete from cart only when payment succeeded
            foreach ($items as $item) {
                $this->cartServices->delete(auth('web')->user(), $item->rowId); // un/comment later
            }
            Session()->flash('success', 'Order placed successfully');
            return redirect()->route('user.my-orders.index');
        }
        Session()->flash('error', 'Order could not be place');
        return redirect()->route('user.my-orders.index');
    }

}
