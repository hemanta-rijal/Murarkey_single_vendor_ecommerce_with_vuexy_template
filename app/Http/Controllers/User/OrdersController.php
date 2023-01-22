<?php

namespace App\Http\Controllers\User;

use App\Http\Arrays\Orders\OrderItemPrintDataArray;
use App\Http\Arrays\Orders\OrderPrintDataArray;
use App\Http\Controllers\Controller;
use Modules\PaymentVerification\Services\PaymentVerificationServices;
use App\Traits\SubscriptionDiscountTrait;
use App\Traits\UserTypeTrait;
use Barryvdh\DomPDF\Facade as PDF;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Contracts\CartService;
use Modules\Orders\Contracts\OrderService;
use Modules\Users\Contracts\UserService;

class OrdersController extends Controller
{
    use SubscriptionDiscountTrait;
    use UserTypeTrait;

    private $orderService;
    private $paymentVerificationServices;
    private $cartService;
    private $userService;

    public function __construct(CartService $cartService,
                                OrderService $orderService,
                                PaymentVerificationServices $paymentVerificationServices,
                                UserService $userService)
    {
        $this->orderService = $orderService;
        $this->paymentVerificationServices = $paymentVerificationServices;
        $this->cartService = $cartService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // check order verify or not
        $orders = $this->orderService->getOrdersByCompanyId(auth('web')->user()->seller->company_id);
        return view('user.orders.company-orders', compact('orders'));
    }

    public function getAllOrders()
    {
        // check order verify or not
        $orders = $this->orderService->getAll();
        return view('user.orders.company-orders', compact('orders'));
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
        //check if billing address is set or not
        if($this->userService->getLogedInUser()->shipment_details==null && $this->userService->getLogedInUser()->billing_details==null){
            Session()->flash('error', 'Billing and Shipping detail required');
            return redirect()->to('user/my-account/user-info/edit');
        }
        $carts = $this->cartService->getCartByUser($this->userService->getLogedInUser());
        $orderPlace = $this->orderService->add($this->userService->getLogedInUser(), $carts['content'], $request);
        Session()->flash(!$orderPlace['status'] ? 'error':'success', $orderPlace['message']);
        return redirect()->route('user.my-orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $order = $this->orderService->findById($id);

        $serviceOrderItem = $order->items->filter(function ($item) {
            if (array_key_exists('product_type', $item->options)) {
                return $item->options['product_type'] == 'service';
            }
        });
        $productOrderItem = $order->items->filter(function ($item) {
            if (array_key_exists('product_type', $item->options)) {
                return $item->options['product_type'] == 'product';
            }
        });
        return view('frontend.user.order-summary')->with([
            'order' => $order,
            'productOrderItems' => $productOrderItem,
            'serviceOrderItems' => $serviceOrderItem,
        ]);
    }

    public function downloadPdf($id)
    {
        $orderItemData = array();
        $order = $this->orderService->findById($id);
        $orderData = new OrderPrintDataArray($order);
        $orderData= $orderData->toArray();
        foreach ($order->items as $key => $value) {
            $orderItem=  new OrderItemPrintDataArray($value);
            $orderItem = $orderItem->toArray();
            $orderItemData[$key]=$orderItem;
        }
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('frontend.user.printable-summary', [
            'orderData' => $orderData,
            'orderItemData' => $orderItemData,
            'logo'=>get_site_logo()
        ]);

        return $pdf->download('order-summary.pdf');
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
        $this->orderService->update($id, $request->only(['status', 'remarks']));

        return back();
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

    public function updateSellerInfo(Request $request, $orderId)
    {
        $this->orderService->changeSellerInfo($orderId, $request->only('item'));

        return back();
    }

}
