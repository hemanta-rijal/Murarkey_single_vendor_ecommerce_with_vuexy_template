<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceOrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd($this);
        return [
            "id" => $this->id,
            'qty' => $this->qty,
            'price' => $this->price,
            "image" => map_storage_path_to_link($this->options['photo']),
            "caption" => $this->remarks,
            "srevice_id" => $this->product_id,
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
