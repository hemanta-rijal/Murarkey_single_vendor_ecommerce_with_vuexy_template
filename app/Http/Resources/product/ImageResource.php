<?php

namespace App\Http\Resources\product;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            "caption" => $this->caption,
            "imagePath" => $this->image,
            "image" => map_storage_path_to_link($this->image),

            // "image" => URL::asset($this->image),
            // "imageUrl" => map_storage_path_to_link($this->image),
            // "image200_x200_url" => resize_image_url($this->image, '200X200'),
            // "image600_x600_url" => resize_image_url($this->image, '600X600'),
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
