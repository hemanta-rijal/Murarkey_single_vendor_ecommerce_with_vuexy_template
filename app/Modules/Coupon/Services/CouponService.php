<?php

namespace Modules\Coupon\Services;

use App\Models\Coupon;
use App\Models\Product;
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
        //manage json for coupon for
        $couponFor = [];
        foreach ($data['coupon_for'] as $key=>$value){
            if($value=='all_services') $couponFor['all_services']=true;
            if($value=='all_product') $couponFor['all_product']=true;
        }
        if(isset($data['brands'])){
            $couponFor['brands']= $data['brands'];
        }
        $data['coupon_for'] = json_encode($couponFor);
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
    public function getByCode($code){
        return $this->CouponRepository->getByCode($code);
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


    /**
     * apply coupon and return discount price and coupon price as array
     *
     * @param $price
     * @param  $type = type is either price or percentage
     * @param $discount
     * @return array
     */
    public function couponApply($price,$type, $discount){
        if($type=='percentage'){
            $discount = $price*$discount/100;
        }
        $price_after_coupon_discount = $price-$discount;
        return [
            'discount'=>$discount,
            'price'=>$price_after_coupon_discount
        ];
    }

    /**
     * check if the item is applicable for coupon
     *
     * @param $item
     * @return bool
     */
    public function couponApplicable($item){
        $couponDetail = session()->get('coupon');
        if($item->associatedModel=='App\Models\Product' && in_array('all_product',$couponDetail['coupon_for'])){
            return true;
        }elseif($item->associatedModel=='App\Models\Product' && in_array('brands',$couponDetail['coupon_for'])){
            $product = Product::find($item->id);
            if($product->brand->id == $couponDetail['coupon_for']['brands']){
                return true;
            }
            return false;
        }elseif ($item->associatedModel=="App\Models\Service" && array_key_exists('all_services',$couponDetail['coupon_for'])){
            return true;
        }
        return false;
    }

}
