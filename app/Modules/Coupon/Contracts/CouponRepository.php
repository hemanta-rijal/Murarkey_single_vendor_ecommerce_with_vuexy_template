<?php

namespace Modules\Coupon\Contracts;

interface CouponRepository
{
    public function findById($id);
    public function getAll();
    public function create($data);
    public function update($id, $data);
    public function delete($id);
    public function getByCode($code);
}
