<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/22/18
 * Time: 7:48 PM
 */

namespace Modules\Orders\Contracts;


interface OrderRepository
{
    public function delete($id);

    public function findById($id);

    public function update($id, $data);

    public function create($data);

    public function createOrder($companyId, $user, $cartItems, $shipmentData, $paymentMethod);

    public function getOrdersByUserId($userId);

    public function getOrdersByCompanyId($companyId);

    public function getDataForReportGeneration($request);

    public function changeSellerInfo($orderId, $data);

}