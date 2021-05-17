<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 11/2/18
 * Time: 1:36 PM
 */

namespace Modules\FlashSales\Contracts;


interface FlashSalesRepository
{

    public function delete($id);

    public function update($id, $data);

    public function findById($id);

    public function create($data);

    public function getPaginated($number = 15);

    public function getAll();

    public function getDataForApi();

}