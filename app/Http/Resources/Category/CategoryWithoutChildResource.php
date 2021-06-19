<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class CategoryWithoutChildResource extends JsonResource
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
            "productCount" => $this->product_count,
            "iconImagePath" => $this->icon_path,
            "icon" => URL::asset($this->icon_path),
            "imagePath" => $this->image_path,
            "image" => URL::asset($this->image_path),
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
