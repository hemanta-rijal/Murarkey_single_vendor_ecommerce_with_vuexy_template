<?php

namespace Modules\Coupon\Repositories;

use App\Models\Coupon;
use Modules\Coupon\Contracts\CouponRepository;

class DbCouponRepository implements CouponRepository
{
    public function create($data): Coupon
    {
        return Coupon::create($data);
    }

    public function findById($id)
    {
        return Coupon::findOrFail($id);
    }

    public function getAll()
    {
        return Coupon::all();
    }
    public function update($id, $data)
    {
        return $this->findById($id)->update($data);
    }

    public function delete($id)
    {
        $node = $this->findById($id);

        return $node->delete();
    }

    public function getPaginated($number)
    {
        return Category::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }

}
