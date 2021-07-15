<?php

namespace Modules\Coupon\Repositories;

use App\Models\Coupon;
use App\Models\CouponAppliedProducts;
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

        $coupon = $this->findById($id);

        \DB::transaction(function () use ($coupon, $data) {
            $coupon->fill($data);

            $products = [];

            if (isset($data['products'])) {
                foreach ($data['products'] as $product) {
                    if (!isset($product['id'])) {
                        $products[] = new CouponAppliedProducts($product);
                    } else {
                        $this->updateCouponAppliedProducts($product);
                    }
                }
            }

            $coupon->items()->saveMany($products);

            if (isset($data['remove_item'])) {
                foreach ($data['remove_item'] as $item) {
                    $this->deleteCouponAppliedProduct($item);
                }
            }

            return $coupon->save();

        });

    }

    private function updateCouponAppliedProducts($item)
    {
        $itemObj = CouponAppliedProducts::findOrFail($item['id']);

        $itemObj->fill($item);
        $itemObj->save();
    }

    private function deleteCouponAppliedProduct($item)
    {
        CouponAppliedProducts::destroy($item);
    }

    public function delete($id)
    {
        $node = $this->findById($id);

        return $node->delete();
    }

    public function getPaginated($number)
    {
        return Coupon::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }

}
