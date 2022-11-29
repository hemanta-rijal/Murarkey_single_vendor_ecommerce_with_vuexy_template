<?php

namespace App\Http\Resources\product;

use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\Brand\BrandResourceCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryWithoutChildResource;
use App\Http\Resources\Review\ReviewResource;
use App\Models\Product;
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
                "discount_rate" => $this->discount_rates,
                'price_after_discount' => $this->applyDiscount(),
                "brand" => new BrandResource($this->brand),
                "category" => new CategoryResource($this->category),
                "images" => ImageResource::collection($this->images),
                "reviewable"=>get_can_review(auth()->user(),$this->id),
                'reviews'=>ReviewResource::collection($this->reviews),
                'average_review'=>4.00,
                Product::SKIN_TYPE=>$this->skin_type_array,
                Product::SKIN_CONCERN=>$this->skin_concern_array,
                Product::PRODUCT_TYPE=>$this->product_type_array,
                'attribute'=>$this->attributeArray(false),
                'web_url'=>env("APP_URL", "https://murarkey.com/")."/products"."/".$this->slug
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
