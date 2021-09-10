<?php

namespace Modules\Orders\Contracts;

interface OrderService
{
    public function getAll();

    public function findById($id);

    public function add($user, $items, $paymentMethod, $date, $time);

    public function getOrdersByUserId($id);

    public function getOrdersListForApi($userId);

    public function getOrdersByCompanyId($companyId);

    public function changeStatus($id, $status);

    public function uploadVoucher($id, $voucher_path);

    public function getDataForReportGeneration($request);

    public function changeSellerInfo($orderId, $only);

    public function update($id, $data);
}
