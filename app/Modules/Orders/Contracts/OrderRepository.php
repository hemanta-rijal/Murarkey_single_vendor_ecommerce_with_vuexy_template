<?php

namespace Modules\Orders\Contracts;


interface OrderRepository
{
    public function delete($id);

    public function findById($id);

    public function update($id, $data);

    public function create($data);

    public function createOrder($companyId, $user, $cartItems, $paymentMethod,$ref_code=null);

    public function getOrdersByUserId($userId);

    public function getOrdersByCompanyId($companyId);

    public function getDataForReportGeneration($request);

    public function changeSellerInfo($orderId, $data);

}