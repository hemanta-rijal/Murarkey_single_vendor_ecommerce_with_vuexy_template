<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Modules\PaymentVerification\Services\PaymentVerificationServices;
use App\Traits\UserTypeTrait;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Modules\Orders\Contracts\OrderService;

class OrdersController extends Controller
{
    use UserTypeTrait;

    private $orderService;
    private $paymentVerificationServices;

    public function __construct(OrderService $orderService, PaymentVerificationServices $paymentVerificationServices)
    {
        $this->orderService = $orderService;
        $this->paymentVerificationServices = $paymentVerificationServices;
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
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->orderService->findById($id);
        return view('frontend.user.order-summary')->with('order', $order);
    }

    public function downloadPdf($id)
    {
        $orderData = [];
        $orderItemData = [];

        $order = $this->orderService->findById($id);
        $orderData['orderCode'] = $order->code;
        $orderData['orderDate'] = $order->created_at->format('d-m-Y  h:i A');
        $orderData['status'] = $order->status;
        $orderData['customer'] = $order->user->name;
        $orderData['email'] = $order->user->email;
        $orderData['shippingAddress'] = $order->user->shipment_details ? $order->user->shipment_details->specific_address : '';
        $orderData['contact'] = $order->user->phone_number ?? '-';
        $orderData['total'] = $order->total;
        $orderData['paymentMethod'] = $order->payment_method;
        foreach ($order->items as $key => $value) {
            // $orderItemData[$key]['photo'] = base64Image($value->product->featured_image);
            $orderItemData[$key]['name'] = $value->product->name;
            $orderItemData[$key]['price'] = $value->price;
            $orderItemData[$key]['qty'] = $value->qty;
        }
        // dd($orderItemData[0]['photo']);
        $summary = getOrderSummary($order);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('frontend.user.printable-summary', [
            'orderData' => $orderData,
            'orderItemData' => $orderItemData,
            'summary' => $summary,
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
