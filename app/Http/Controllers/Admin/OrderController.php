<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Orders\Services\OrderService;

class OrderController extends Controller
{

    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function getAllOrders()
    {
        $orders = $this->orderService->getAll();
        return view('admin.orders.index')->with(compact('orders'));
    }

    public function getOrderDetail($id)
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
        return view('admin.orders.order-details')->with([
            'order' => $order,
            'productOrderItems' => $productOrderItem,
            'serviceOrderItems' => $serviceOrderItem,
        ]);

    }

    public function changeStatus($id)
    {
        $this->orderService->changeStatus($id, 'cancelled');
        flash('order status changed successfully')->success();
        return redirect()->route('admin.orders.index');
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
            $orderItemData[$key]['name'] = $value->options['product_type'] == "product" ? $value->product->name : $value->service->title;
            $orderItemData[$key]['price'] = $value->price;
            $orderItemData[$key]['qty'] = $value->qty;
            $orderItemData[$key]['type'] = $value->type;
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

    public function destroy($id)
    {
        try {

            $order = $this->orderService->findById($id);
            if ($order) {
                $this->orderService->delete($order->id);
            }
            flash('data deleted successfully');
            return $this->redirectTo();
        } catch (\Throwable $th) {
            flash('data could not be deleted');
            flash($th->getMessage());
            return $this->redirectTo();
        }

    }

}
