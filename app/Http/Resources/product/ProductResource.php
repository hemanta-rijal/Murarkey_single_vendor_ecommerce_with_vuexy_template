<?php

namespace App\Http\Resources\product;

use App\Http\Resources\Category\CategoryWithoutChildResource;
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
        $tags = array(0 => "Clothing", 1 => "T-shirt", 2 => "Woman");
        $sub_category = array(0 => "More Accessories", 1 => "Wallets & Cases");

        return
            [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "brand_name" => $this->brand_name,
            "details" => $this->details,
            // 'tags'=>this->keywords,
            'tags' => json_encode($tags),
            'tags_array' => $tags,
            "shipping_details" => $this->shipping_details,
            "packing_details" => $this->packing_details,
            "unit_type" => $this->unit_type,
            "featured" => $this->featured,
            "category" => new CategoryWithoutChildResource($this->category),
            "sub_category" => json_encode($sub_category),
            "sub_category_array" => $sub_category,
            "status" => $this->status,
            // "created_at" => $this->created_at->format('d, M-Y'),
            "out_of_stock" => $this->out_of_stock,
            "made_in" => $this->made_in,
            "sku" => 00012,
            "price" => $this->price,
            "discountType" => $this->discount_type,
            "a_discount_price" => $this->a_discount_price,
            'price_after_discount' => $this->price_after_discount,
            "images" => ImageResource::collection($this->images),
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
