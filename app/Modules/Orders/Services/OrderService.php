<?php

namespace Modules\Orders\Services;

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

    public function findById($id)
    {
        return $this->orderRepository->findById($id);
    }
    public function getAll()
    {
        return $this->orderRepository->getAll();
    }

    public function add($user, $items, $paymentMethod, $date=null, $time=null)
    {
        $order = $this->orderRepository->createOrder($user, $items, $paymentMethod, $date, $time);
    }

    public function getOrdersByUserId($userId)
    {

        $orders = $this->orderRepository->getOrdersByUserId($userId);

        $orders->load('items.product.images');

        return $orders;
    }

    public function getOrdersListForApi($userId)
    {

        $orders = $this->orderRepository->getOrdersListForApi($userId);
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

        if ($status == Order::ORDER_CANCEL) {
            foreach ($order->items as $item) {
                $item->status = OrderItem::ORDER_CANCEL;
                $item->save();
                if ($item->type == 'product') {
                    $this->orderRepository->updateProductsStock($item->product_id, $item->qty, true);
                }
            }
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
