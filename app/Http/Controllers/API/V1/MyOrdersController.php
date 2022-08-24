<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\Orders\OrderResource;
use App\Http\Resources\Orders\ProductOrderItemResource;
use App\Http\Resources\Orders\ServiceOrderItemResource;
use App\Models\Order;
use App\Traits\SubscriptionDiscountTrait;
use App\Traits\UserTypeTrait;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Contracts\CartService;
use Modules\Orders\Contracts\OrderService;
use Modules\Orders\Requests\VoucherUploadRequest;
use Modules\Users\Contracts\UserService;

class MyOrdersController extends BaseController
{
    use SubscriptionDiscountTrait;
    use UserTypeTrait;

    private $orderService;
    private $cartService;
    private $userService;

    public function __construct(CartService $cartService,OrderService $orderService,UserService $userService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->orderService->getOrdersByUserId(auth()->user()->id);
    }

    public function myOrders()
    {
        $orders = $this->orderService->getOrdersListForApi(auth()->user()->id);
        return OrderResource::collection($orders);
    }
    public function myOrdersServices($id)
    {
        $order = $this->orderService->findById($id);

        $serviceOrderItems = $order->items->filter(function ($item) {
            if (array_key_exists('product_type', $item->options)) {
                return $item->options['product_type'] == 'service';
            }
        });

        return ServiceOrderItemResource::collection($serviceOrderItems);

    }
    public function myOrdersProducts($id)
    {
        $order = $this->orderService->findById($id);

        $productOrderItems = $order->items->filter(function ($item) {
            if (array_key_exists('product_type', $item->options)) {
                return $item->options['product_type'] == 'product';
            }
        });
        return ProductOrderItemResource::collection($productOrderItems);
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
            return response()->json(['data'=>'','status'=>false,'message'=>'Shipping and Billing address is not updated'],200);
        }
        $carts = $this->cartService->getCartByUser($this->userService->getLogedInUser());
        $items = $this->processItems($carts['content']);
        $this->orderService->add($this->userService->getLogedInUser(), $items, $request);

        Cart::destroy();
        DB::table('shopping_cart')->where('identifier',$this->userService->getLogedInUser()->id)->delete();
        Session()->flash('success', 'Order placed successfully');
       return response()->json(['data'=>'','status'=>true,'message'=>'Thank you for ordering with us.'],200);
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

    public function update(VoucherUploadRequest $request, $id)
    {
        $this->orderService->uploadVoucher($id, $request->voucher_path);

        return ['status' => 'ok'];
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

    public function cancelOrder($orderId)
    {
        $this->orderService->changeStatus($orderId, Order::ORDER_CANCEL);
        return [
            'message' => 'order cancelled',
            'status' => 200,
            'success' => true,
        ];
    }
}
