<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Order;
use Modules\Orders\Requests\VoucherUploadRequest;
use Illuminate\Http\Request;
use Modules\Orders\Contracts\OrderService;

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
        return $this->orderService->getOrdersByUserId($this->auth->user()->id);
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

    public function cancelOrder($orderId) {
        $this->orderService->changeStatus($orderId, Order::ORDER_CANCEL);
    }
}
