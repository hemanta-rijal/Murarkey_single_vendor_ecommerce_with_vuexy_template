<?php

namespace App\Http\Resources\Banner;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class BannerResource extends JsonResource
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
            "position" => $this->position,
            "name" => $this->name,
            "image" => $this->image,
            "imageUrl" => map_storage_path_to_link($this->image),
            "link" => null,
        ];
    }
}
