<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class CategoryResource extends JsonResource
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
            "name" => $this->name,
            "slug" => $this->slug,
            "parentID" => $this->parent_id,
            "description" => $this->description,
            "_lft" => $this->_lft,
            "_rgt" => $this->_rgt,
            "productCount" => $this->product_count,
            "icon" => URL::asset($this->icon_path),
            "image" => URL::asset($this->icon_path),
            "children" => CategoryResource::collection($this->child_category),
        ];
    }
}
