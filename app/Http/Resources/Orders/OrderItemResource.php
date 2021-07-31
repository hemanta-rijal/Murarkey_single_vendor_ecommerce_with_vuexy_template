<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'qty' => $this->qty,
            'price' => $this->price,
            "image" => map_storage_path_to_link($this->options['photo']),
            "caption" => $this->remarks,
            "product_id" => $this->product_id,
            "name"=>$this->type=="product" ? $this->product->name : $this->service->name
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
