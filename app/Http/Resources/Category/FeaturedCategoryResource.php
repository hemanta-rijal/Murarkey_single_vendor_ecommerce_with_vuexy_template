<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class FeaturedCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd($this->products);
        return [
            "id" => $this->id,
            "name" => $this->name,
            "weight" => $this->weight,
            "category_id" => $this->category_id,
            "product_count" => $this->FeaturedCategoriesHasProduct->count(),
            "products" => FeaturedCategoryHasProductsResource::collection($this->FeaturedCategoriesHasProduct),
            "category" => new CategoryResource($this->category),
        ];
    }
}
