<?php

namespace App\Traits;

/**
 * Trait ProductAndServiceTrait
 * @package App\Traits
 */
trait ProductAndServiceTrait{

    /**
     * calculate price if product price exclude tax
     *
     * @param $price
     * @param $tax_rate
     * @return float|int
     */
    public function PriceAfterTaxCalculation($price, $tax_rate){
        return $price+$this->getTaxAmountWhichExcludeTax($price, $tax_rate);
    }

    /**
     * calculate price if product price include tax
     *
     * @param $price
     * @param $tax_rate
     * @return float|int
     */
    public function priceAfterReverseTaxCalculation($price, $tax_rate){
        return ($price*100)/(100+$tax_rate);
    }

    /**
     * calculate tax if product price include tax
     *
     * @param $price
     * @param $tax_rate
     * @return integer
     *
     */
    public function getTaxAmountAfterReverseTaxCalculation($price, $tax_rate){
        return $price-$this->priceAfterReverseTaxCalculation($price, $tax_rate);
   }

   public function getTaxAmountWhichExcludeTax($price,$tax_rate){
        return  $price*$tax_rate/100;
   }

    /**
     * apply coupon on either product and service
     *
     * @param $item
     * @param bool $taxCalculationMethod
     */

    public function calculateCouponAppliedItem($item, $taxCalculationMethod=true){
       $couponDetail = session()->get('coupon');

       if($item->associatedModel=='App\Models\Product' && array_key_exists('all_product',$couponDetail['coupon_for'])) {
           $couponDiscountDetailOnItem = $this->couponApply($this->price, $couponDetail['discount_type'], $couponDetail['discount']);
       }
       //if coupon for special brands
       elseif($item->associatedModel=='App\Models\Product' && array_key_exists('brands',$couponDetail['coupon_for'])){
           if($this->brand->id == $couponDetail['coupon_for']['brands']){
               $couponDiscountDetailOnItem= $couponDiscountDetailOnItem = $this->couponApply($this->price, $couponDetail['discount_type'], $couponDetail['discount']);
               dd($couponDiscountDetailOnItem);
           }else{

           }
       }else{
//           dd('test');


//           if ($couponDetail['discount_type']=="percentage"){
//               $taxOnItem =  $taxCalculationMethod ? $this->PriceAfterReverseTaxCalculation($item->price,get_meta_by_key('custom_tax_on_product')):$this->taxCalculation($item->price,get_meta_by_key('custom_tax_on_product'));
//               $priceWithoutTax = $item->price-$taxOnItem;
//               $subTotalForItem = $priceWithoutTax * $item->qty;
//               $couponDiscountPriceForItem = $subTotalForItem*$couponDetail['discount']/100;
////               $couponDiscountPrice+= $couponDiscountPriceForItem;
////               $taxCalculationForCouponAppliedProduct+= ($subTotalForItem-$couponDiscountPriceForItem) * get_meta_by_key('custom_tax_on_product')/100;
//           }

       }
   }

}