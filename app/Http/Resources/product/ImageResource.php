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
            "image" => $this->image,
            "caption" => $this->caption,
            "imageUrl" => URL::asset($this->image),
            "image200_x200_url" => resize_image_url($this->image, '200X200'),
            "image600_x600_url" => resize_image_url($this->image, '600X600'),
        ];
    }
}
