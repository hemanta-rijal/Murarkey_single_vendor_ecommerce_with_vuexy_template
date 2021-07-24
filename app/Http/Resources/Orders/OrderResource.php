<?php

namespace App\Http\Resources\Orders;

use App\Http\Resources\Orders\OrderItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd($this->items);
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "code" => $this->code,
            "status" => $this->status,
            // "shipment_details" => $this->shipment_details,
            // "billing_details" => $this->shipment_details,
            "order_date" => $this->created_at->format('d-M,Y h:i A'),
            "updated_at" => $this->updated_at->format('d-M,Y h:i A'),
            "payment_method" => $this->payment_method,
            "remarks" => $this->remarks,
            'shipping_charge' => getOrderSummary($this)['shipping_charge'],
            'sub_total' => getOrderSummary($this)['subTotal'],
            'tax' => getOrderSummary($this)['tax'],
            "total" => getOrderSummary($this)['total'],
            "items" => [
                'products' => OrderItemResource::collection($this->items->where('type', 'product')),
                'services' => OrderItemResource::collection($this->items->where('type', 'service')),
            ],
            // "product_items" => OrderItemResource::collection($this->items->where('type', 'product')),
            // "service_items" => OrderItemResource::collection($this->items->where('type', 'service')),

        ];
    }
    public function with($request)
    {
        return [
            'message' => 'successfully fetched',
            'success' => true,
            'status' => 200,
        ];
    }
}
