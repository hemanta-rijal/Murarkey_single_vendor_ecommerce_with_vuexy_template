<?php

namespace App\Http\Resources\Parlour;

use App\Http\Resources\Service\ServiceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ParlourResource extends JsonResource
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
            "address" => $this->address,
            "about" => $this->about,
            "featureImageUrl" => map_storage_path_to_link($this->feature_image),
            "featured" => $this->featured,
            "status" => $this->status,
            "phone" => $this->phone,
            "mobile" => $this->mobile,
            "email" => $this->email,
            "website" => $this->website,
            "facebook" => $this->facebook,
            "instagram" => $this->instagram,
            "twitter" => $this->twitter,
            "youtube" => $this->youtube,
            'services'=> ServiceResource::collection($this->services)
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
