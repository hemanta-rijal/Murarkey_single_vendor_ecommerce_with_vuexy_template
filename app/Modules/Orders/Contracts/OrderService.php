<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/22/18
 * Time: 7:47 PM
 */

namespace Modules\Orders\Contracts;


interface OrderService
{

    public function add($user, $items, $shipmentData, $paymentMethod);

    public function getOrdersByUserId($id);

    public function getOrdersByCompanyId($companyId);

    public function changeStatus($id, $status);

    public function uploadVoucher($id, $voucher_path);

    public function getDataForReportGeneration($request);

    public function changeSellerInfo($orderId, $only);

    public function update($id, $data);
}