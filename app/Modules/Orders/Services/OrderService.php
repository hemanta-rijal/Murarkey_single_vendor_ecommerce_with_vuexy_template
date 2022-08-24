<?php

namespace Modules\Orders\Services;

use App\Events\OrderPlacedEvent;
use App\Models\Order;
use App\Models\OrderItem;
use Modules\Orders\Contracts\OrderRepository;
use Modules\Orders\Contracts\OrderService as OrderServiceContract;
use Modules\Wallet\Services\WalletService;

class OrderService implements OrderServiceContract
{
    private $orderRepository;
    private $walletService;

    public function __construct(OrderRepository $orderRepository,WalletService $walletService)
    {
        $this->orderRepository = $orderRepository;
        $this->walletService = $walletService;
    }

    public function findById($id)
    {
        return $this->orderRepository->findById($id);
    }
    public function getAll()
    {
        return $this->orderRepository->getAll();
    }

    public function add($user, $items, $request)
    {
        try{
            $order = $this->orderRepository->createOrder($user, $items, $request);
            //wallet transaction check wallet
            if($request->use_wallet==1){
                $this->walletService->orderUsingWallet($order->total_price,$user->id);
            }
            if (checkEmailOrPhone($user->email) == "email")
            event(new OrderPlacedEvent($order, $user));
        }catch (\PDOException $exception){

        }

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
