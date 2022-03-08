<?php

namespace App\Traits;

/**
 * Trait ProductAndServiceTrait
 * @package App\Traits
 */
trait ProductAndServiceTrait
{

    /**
     * calculate price if product price exclude tax
     *
     * @param $price
     * @param $tax_rate
     * @return float|int
     */
    public function PriceAfterTaxCalculation($price, $tax_rate)
    {
        return $price + $this->getTaxAmountWhichExcludeTax($price, $tax_rate);
    }

    /**
     * calculate price if product price include tax
     *
     * @param $price
     * @param $tax_rate
     * @return float|int
     */
    public function priceAfterReverseTaxCalculation($price, $tax_rate)
    {
        return ($price * 100) / (100 + $tax_rate);
    }

    /**
     * calculate tax if product price include tax
     *
     * @param $price
     * @param $tax_rate
     * @return integer
     *
     */
    public function getTaxAmountAfterReverseTaxCalculation($price, $tax_rate)
    {
        return $price - $this->priceAfterReverseTaxCalculation($price, $tax_rate);
    }

    /**
     * tax amount which exclude tax
     *
     * @param $price
     * @param $tax_rate
     * @return float|int
     */
    public function getTaxAmountWhichExcludeTax($price, $tax_rate)
    {
        return $price * $tax_rate / 100;
    }

    public function applyDiscount(){

        if ($this->discount_type == "flat_rate") {
            return $this->price - $this->discount_rates;
        }

        if ($this->discount_type == "percentage") {
            return    ($this->price * (100 - $this->discount_rates)) / 100;
        }
        if ($this->discount_type == "discount_price") {
            return $this->price - $this->discount_rates;

        }
        return $this->price;
    }


}