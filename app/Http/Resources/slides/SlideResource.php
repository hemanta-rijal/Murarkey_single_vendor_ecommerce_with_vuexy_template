<?php

namespace App\Http\Resources\slides;

use Illuminate\Http\Resources\Json\JsonResource;

class SlideResource extends JsonResource
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

            "imagePath" => $this->image,
            "imageUrl" => map_storage_path_to_link($this->image),
            "caption" => $this->caption,
            "weight" => $this->weight,
            "link" => $this->link,
        ];
    }

    public function with($request)
    {
        return [
            'message' => 'successfully fetched',
            'success' => true,
            'status' => 200,
        ];
    }
}
