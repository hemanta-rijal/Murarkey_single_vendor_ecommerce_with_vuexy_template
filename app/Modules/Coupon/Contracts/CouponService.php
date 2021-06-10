<?php

namespace Modules\Coupon\Contracts;

interface CouponService
{
    public function findById($id);
    public function getAll();
    public function getAllFeatured();
    public function create($data);
    public function update($id, $data);
    public function delete($id);

}
