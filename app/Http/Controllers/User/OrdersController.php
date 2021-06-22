<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Traits\UserTypeTrait;
use Illuminate\Http\Request;
use Modules\Orders\Contracts\OrderService;

class OrdersController extends Controller
{
    use UserTypeTrait;


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
//        check order verify or not
        $orders = $this->orderService->getOrdersByCompanyId(auth()->user()->seller->company_id);
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
