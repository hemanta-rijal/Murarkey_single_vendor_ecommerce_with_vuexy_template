<?php

namespace App\Http\Resources\product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
        return
            [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "brand_name" => $this->brand_name,
            "details" => $this->details,
            "shipping_details" => $this->shipping_details,
            "packing_details" => $this->packing_details,
            "unit_type" => $this->unit_type,
            "featured" => $this->featured,
            "category_id" => $this->category_id,
            "status" => $this->status,
            // "created_at" => $this->created_at->format('d, M-Y'),
            "out_of_stock" => $this->out_of_stock,
            "made_in" => $this->made_in,
            "price" => $this->price,
            "discountType" => $this->discount_type,
            "a_discount_price" => $this->a_discount_price,
            "images" => ImageResource::collection($this->images),
        ];
    }
    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200,
        ];
    }
}
