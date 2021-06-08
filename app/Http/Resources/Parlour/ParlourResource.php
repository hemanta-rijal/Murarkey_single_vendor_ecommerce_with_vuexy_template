<?php

namespace App\Http\Resources\Parlour;

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
            "slug" => $this->slug,
            "address" => $this->address,
            "about" => $this->about,
            "category_id" => $this->category_id,
            "feature_image" => $this->feature_image,
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
            "deleted_at" => $this->deleted_at,
        ];
    }
}
