<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class FeaturedCategoryHasProductsResource extends JsonResource
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
            "weight" => $this->weight,
            "featured_category_id" => $this->featured_category_id,
            "product_id" => $this->product_id,
            // "product" => new ProductResource($this->product),
        ];
    }
}
