<?php


namespace App\Http\Arrays\Orders;


use App\Models\OrderItem;

class OrderItemPrintDataArray
{
    private $orderItem;
    public function __construct(OrderItem $orderItem)
    {
        $this->orderItem = $orderItem;
    }

    public function toArray(){

        return [
            'name'=>$this->orderItem->options['product_type'] == "product" ? $this->orderItem->product->name : $this->orderItem->service->title,
            'price'=>$this->orderItem->price,
            'qty'=>$this->orderItem->qty
        ];
    }
}