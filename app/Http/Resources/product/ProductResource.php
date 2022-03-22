<?php

namespace App\Http\Resources\product;

use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\Brand\BrandResourceCollection;
use App\Http\Resources\Category\CategoryWithoutChildResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\False_;

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
        return
            [
                "id" => $this->id,
                "name" => $this->name,
                "slug" => $this->slug,
                "details" => $this->details,
                "shipping_details" => $this->shipping_details,
                "packing_details" => $this->packing_details,
                "unit_type" => $this->unit_type,
                "featured" => $this->featured,
                "status" => $this->status,
                "out_of_stock" => $this->out_of_stock,
                "sku" => $this->sku,
                "price" => $this->price,
                "discountType" => $this->discount_type,
                "discount_rate" => $this->a_discount_price,
                'price_after_discount' => $this->price_after_discount,
                "brand" => new BrandResource($this->brand),
                "category" => new CategoryWithoutChildResource($this->category),
                "images" => ImageResource::collection($this->images),
                "reviewable"=>auth()->check() ? true : false
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
