<?php

namespace Modules\Orders\Repositiories;


use App\Events\SellerAWBNoUpdated;
use App\Events\SellerOrderNoUpdated;
use App\Models\Order;
use App\Models\OrderItem;
use DB;
use Modules\Orders\Contracts\OrderRepository;

class DbOrderRepository implements OrderRepository
{
    public function delete($id)
    {
        Order::destroy($id);
    }

    public function findById($id)
    {
        return Order::findOrFail($id);
    }

    public function update($id, $data)
    {
        $order = Order::findOrFail($id);

        $order->fill($data);

        $order->save();

        return $order;
    }

    public function create($data)
    {
        $order = new Order();

        $order->fill($data);

        $order->save();

        return $order;
    }

    public function createOrder($user, $cartItems, $paymentMethod,$ref_code=null)
    {
        $order = new Order();
        $order->user_id = $user->id;

//        $order->billing_details = $user->billinginfo;
        $order->shipment_details = $user->shipmentinfo;
        $order->status = Order::ORDER_INITIAL;
        $order->payment_method = $paymentMethod;
//        $order->payment_method_ref_code = $ref_code;
        $orderItems = [];
        foreach ($cartItems as $item) {
            
            if ($item->doDiscount)
                $item->price = ceil($item->price * 0.5) + ceil($item->price * 0.13);

            $item->status = OrderItem::ORDER_INITIAL;
        }

        foreach ($cartItems as $cartItem) {
            $orderItems[] = OrderItem::fromCartItem($cartItem);
        }

//        DB::transaction(function () use ($order, $orderItems) {
            $order->save();
            $order->items()->saveMany($orderItems);
//        });

        return $order;
    }

    public function getOrdersByUserId($userId)
    {
        return Order::where('user_id', $userId)->latest()->paginate(10);
    }

    public function getOrdersByCompanyId($companyId)
    {
        return Order::distinct()->select('orders.*')->where('company_id', $companyId)->leftJoin('order_item', 'orders.id', '=', 'order_item.order_id')->when(request()->status, function ($query) {
            return $query->where('order_item.status', request()->status);
        })->when(request()->pm, function ($query) {
            return $query->where('payment_method', request()->pm);
        })->when(request()->search, function ($query) {
            return $query->where(function ($q) {
                $q->where('orders.id', request()->search)
                    ->orWhere('order_item.seller_order_no', request()->search)
                    ->orWhere('order_item.seller_awb_no', request()->search);
            });
        })->orderBy('orders.created_at', 'DESC')->with('items')->paginate(10);
    }

    public function getDataForReportGeneration($request)
    {
        return Order::select('orders.*')->leftJoin('order_item', 'orders.id', '=', 'order_item.order_id')
            ->where('orders.created_at', '>=', $request->from)
            ->where('orders.created_at', '<=', $request->to)
            ->when(request()->status, function ($query) {
                return $query->where('order_item.status', request()->status);
            })->when(request()->payment_method, function ($query) {
                return $query->where('payment_method', request()->payment_method);
            })->groupBy('orders.id')->orderBy('orders.created_at')->with('items.product', 'user')->get();
    }

    public function changeSellerInfo($orderId, $data)
    {
        if (isset($data['item']) && is_array($data['item']))

            $order = Order::findOrFail($orderId);

            foreach ($data['item'] as $key => $item) {
                $itemObj = OrderItem::find($key);

                if ($itemObj) {

                    if ( $itemObj->status != $item['status'])
                        $itemObj->status = $item['status'];

                    if ($itemObj->seller_order_no != $item['seller_order_no']) {
                        event(new SellerOrderNoUpdated($itemObj));
                    }

                    if ($itemObj->seller_awb_no != $item['seller_awb_no']) {
                        event(new SellerAWBNoUpdated($itemObj));
                    }

                    $itemObj->seller_order_no = $item['seller_order_no'];
                    $itemObj->seller_awb_no = $item['seller_awb_no'];

//                    $itemObj->product_link = $item['product_link'];
                    $itemObj->save();



                }
            }
//        return Order::where('id', $orderId)->update($data);
    }
}