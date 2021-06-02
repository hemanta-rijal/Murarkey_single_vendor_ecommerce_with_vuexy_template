<?php


namespace App\Traits;


trait SubscriptionDiscountTrait
{

    public function processItems($items)
    {
        $clonedItems = collect();

        foreach ($items as $item)
            $clonedItems->push(clone $item);

//        $qty = $clonedItems->sum('qty');

//        foreach ($clonedItems as $item) {
//            $item->doDiscount = false;
//        }


//        if ($qty > 1 && auth()->user()->getDiscountAvailable()) {
//            $maxPriceItem = $clonedItems->first();
//
//            foreach ($clonedItems as $item)
//                if ($maxPriceItem->price < $item->price)
//                    $maxPriceItem = $item;
//
//
//            if ($maxPriceItem->qty > 1) {
//                $anotherMaxPriceItem = clone $maxPriceItem;
//
//                $anotherMaxPriceItem->setQuantity(1);
//
//                $maxPriceItem->setQuantity($maxPriceItem->qty - 1);
//
//                $anotherMaxPriceItem->setDoDiscount(true);
//
//
//                $clonedItems->prepend($anotherMaxPriceItem);
//            } else {
//                $maxPriceItem->setDoDiscount(true);
//            }
//        }

        return $clonedItems;
    }

}