<?php

namespace Modules\Coupon\Services;

use App\Models\Coupon;
use Modules\Coupon\Contracts\CouponRepository;
use Modules\Coupon\Contracts\CouponService as CouponContract;

class CouponService implements CouponContract
{

    const DEFAULT_PAGINATION = 10;
    private $CouponRepository;

    public function __construct(CouponRepository $repository)
    {
        $this->CouponRepository = $repository;
    }

    public function getAll()
    {
        return Coupon::all();
    }
    public function getAllFeatured()
    {
        return Coupon::where('featured', true)->get();
    }
    public function create($data): Coupon
    {

        return $this->CouponRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->CouponRepository->update($id, $data);
    }

    public function findById($id)
    {
        return $this->CouponRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->CouponRepository->delete($id);
    }

    public function getPaginated($number = null)
    {
        return $this->CouponRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

}
