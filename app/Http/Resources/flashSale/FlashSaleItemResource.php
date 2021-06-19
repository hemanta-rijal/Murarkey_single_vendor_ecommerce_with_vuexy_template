<?php

namespace App\Http\Resources\flashSale;

use App\Http\Resources\product\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FlashSaleItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
            [
            "id" => $this->id,
            // "weight" => $this->witght,
            "discount_type" => $this->descount_type,
            "discount" => $this->discount,
            "actual_price" => $this->actual_price,
            "discounted_price" => $this->discounted_price,
            "flash_sale_id" => $this->flash_sale_id,
            "created_at" => $this->created_at->format('d,M-Y'),
            "productDetail" => new ProductResource($this->product),
        ];
    }
    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
