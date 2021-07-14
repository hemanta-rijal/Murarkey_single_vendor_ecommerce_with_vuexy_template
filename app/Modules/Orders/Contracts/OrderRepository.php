<?php

namespace Modules\Orders\Contracts;

interface OrderRepository
{
    public function delete($id);

    public function getAll();

    public function findById($id);

    public function update($id, $data);

    public function create($data);

    public function createOrder($user, $items, $paymentMethod);

    public function getOrdersByUserId($userId);

    public function getOrdersListForApi($userId);

    public function getOrdersByCompanyId($companyId);

    public function getDataForReportGeneration($request);

    public function changeSellerInfo($orderId, $data);

}
