<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\Orders\OrderResource;
use App\Http\Resources\Orders\ProductOrderItemResource;
use App\Http\Resources\Orders\ServiceOrderItemResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Modules\Orders\Contracts\OrderService;
use Modules\Orders\Requests\VoucherUploadRequest;

class MyOrdersController extends BaseController
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
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
        // $serviceOrderItems = $order->items->where('type','service')->get();

        // $serviceOrderItems = $order->items->filter(function ($item) {
        //     if (array_key_exists('product_type', $item->options)) {
        //         return $item->options['product_type'] == 'service';
        //     }
        // });

        return ServiceOrderItemResource::collection($serviceOrderItems);

    }
    public function myOrdersProducts($id)
    {
        $order = $this->orderService->findById($id);
        $productOrderItems = $order->items->where('type', 'product')->get();

        // $productOrderItems = $order->items->filter(function ($item) {
        //     if (array_key_exists('product_type', $item->options)) {
        //         return $item->options['product_type'] == 'product';
        //     }
        // });
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
        //
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
