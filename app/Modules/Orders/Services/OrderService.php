<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/22/18
 * Time: 7:54 PM
 */

namespace Modules\Orders\Services;


use App\Events\OrderPlacedEvent;
use App\Models\Order;
use App\Models\OrderItem;
use Modules\Orders\Contracts\OrderRepository;
use Modules\Orders\Contracts\OrderService as OrderServiceContract;

class OrderService implements OrderServiceContract
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function add($user, $items, $shipmentData, $paymentMethod)
    {
        $groupData = $items->groupBy('companyId');

        foreach ($groupData as $companyId => $cartItems) {
            $order = $this->orderRepository->createOrder($companyId, $user, $cartItems, $shipmentData, $paymentMethod);

            event(new OrderPlacedEvent($order, $user));
        }
    }

    public function getOrdersByUserId($userId)
    {

        $orders = $this->orderRepository->getOrdersByUserId($userId);

        $orders->load('items.product.images');

        return $orders;
    }

    public function getOrdersByCompanyId($companyId)
    {
        return $this->orderRepository->getOrdersByCompanyId($companyId);
    }

    public function changeStatus($id, $status)
    {
        $order = $this->orderRepository->findById($id);


        if ($status == Order::ORDER_CANCEL)
            foreach ($order->items as $item) {
                $item->status = OrderItem::ORDER_CANCEL;
                $item->save();
            }

        $order->status = $status;

        $order->save();
    }

    public function uploadVoucher($id, $voucher)
    {
        $order = $this->orderRepository->findById($id);

        $order->voucher_path = $voucher->store('public/vouchers');

        $order->save();
    }


    public function getDataForReportGeneration($request)
    {
        return $this->orderRepository->getDataForReportGeneration($request);
    }


    public function changeSellerInfo($orderId, $data)
    {
        return $this->orderRepository->changeSellerInfo($orderId, $data);
    }

    public function update($id, $data)
    {
        $order = $this->orderRepository->findById($id);

        $order->fill($data);

        $order->save();
    }


}