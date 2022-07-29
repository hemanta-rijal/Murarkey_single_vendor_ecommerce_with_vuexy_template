<?php

namespace Modules\Orders\Repositiories;

use App\Events\OrderPlacedEvent;
use App\Events\SellerAWBNoUpdated;
use App\Events\SellerOrderNoUpdated;
use App\Models\Order;
use App\Models\OrderItem;
use Cart;
use Modules\Orders\Contracts\OrderRepository;
use Modules\Products\Repositories\DbProductRepository;

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

    public function getAll()
    {
        return Order::all();
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

    public function createOrder($user, $cartItems, $paymentMethod, $date, $time, $ref_code = null)
    {
        try {
            $checkout = getCheckoutSession();
            $order = new Order();
            $order->user_id = $user->id;
            $order->code = date('Ymd-His') . rand(10, 99);
            $order->shipment_details = $user->shipment_details;
            $order->billing_details = $user->billing_details;
            $order->status = Order::ORDER_INITIAL;
            $order->payment_method = $paymentMethod;
            $order->date = $date;
            $order->time = $time;
            $order->coupon_detail = ($checkout==null) ? null: (is_array($checkout['couponDetail']) ? $checkout['couponDetail']['coupon']:null);
            $order->coupon_discount_price = $checkout!=null ? $checkout['couponDiscountPrice']:null;
            $order->sub_total = $checkout['subtotal'];
            $order->tax = $checkout['tax'];
            $order->total_price = $checkout['total'];
            $orderItems = [];
            foreach ($cartItems as $cartItem) {
                $cartItem->status = OrderItem::ORDER_INITIAL;
                $orderItems[] = $orderItem = OrderItem::fromCartItem($cartItem);
                if ($orderItem->type == 'product') {
                    checkProductStock($orderItem->product_id);
                    $this->updateProductsStock($orderItem->product_id, $orderItem->qty, false);
                }
            }
            $order->save();
            $order->items()->saveMany($orderItems);
            if (checkEmailOrPhone($user->email) == "email")
                event(new OrderPlacedEvent($order, $user));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return $order;
    }

    public function getOrdersByUserId($userId)
    {
        return Order::where('user_id', $userId)->latest()->paginate(10);
    }

    public function getOrdersListForApi($userId)
    {
        return Order::where('user_id', $userId)->latest()->get();
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
        if (isset($data['item']) && is_array($data['item'])) {
            $order = Order::findOrFail($orderId);
        }

        foreach ($data['item'] as $key => $item) {
            $itemObj = OrderItem::find($key);

            if ($itemObj) {

                if ($itemObj->status != $item['status']) {
                    $itemObj->status = $item['status'];
                }

                if ($itemObj->seller_order_no != $item['seller_order_no']) {
                    event(new SellerOrderNoUpdated($itemObj));
                }

                if ($itemObj->seller_awb_no != $item['seller_awb_no']) {
                    event(new SellerAWBNoUpdated($itemObj));
                }

                $itemObj->seller_order_no = $item['seller_order_no'];
                $itemObj->seller_awb_no = $item['seller_awb_no'];

                $itemObj->save();

            }
        }
    }

    public function updateProductsStock($product_id, $qty, $increment)
    {
        $productRepo = $repo = app(\Modules\Products\Repositories\DbProductRepository::class);
        return $productRepo->updateProductsStock($product_id, $qty, $increment);
    }
}
