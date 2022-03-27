<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

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
            "icon_path" => $this->icon_path,
            "icon_url" => map_storage_path_to_link($this->icon_path),
            "image_path" => $this->image_path,
            "image_url" => map_storage_path_to_link($this->image_url),
            "children" => CategoryResource::collection($this->child_category),
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
