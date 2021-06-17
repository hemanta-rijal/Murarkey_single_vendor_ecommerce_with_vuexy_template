<?php

namespace App\Http\Resources\product;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

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
            "image" => map_storage_path_to_link($this->image),
            "caption" => $this->caption,
            "imageUrl" => map_storage_path_to_link($this->image),
            "image200_x200_url" => resize_image_url($this->image, '200X200'),
            "image600_x600_url" => resize_image_url($this->image, '600X600'),
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
