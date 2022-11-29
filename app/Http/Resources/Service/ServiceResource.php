<?php

namespace App\Http\Resources\Service;

use App\Http\Resources\product\ImageResource;
use App\Http\Resources\Review\ReviewResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'duration' => $this->min_duration.' '.$this->min_duration_unit .' to '.$this->max_duration.' '.$this->max_duration_unit,
            'icon_image' => resize_image_url($this->icon_image, '100X100'),
            // 'service_category' => new ServiceCategoryResource($this->serviceCategory),
            'featured_image' => resize_image_url($this->featured_image, '600X600'),
            "images" => ImageResource::collection($this->images),
            'short_description' => $this->service_quote,
            'description' => $this->description,
            'price' => $this->price,
            'discount_rates'=>$this->discount_rates,
            'discount_type'=>$this->discount_type,
            'price_after_discount'=>$this->applyDiscount(),
            'reviewable'=>get_can_review(auth()->user(),$this->id),
            'reviews'=>ReviewResource::collection($this->reviews),
            'labels'=>$this->serviceLabelArray(),
            'web_url'=>env("APP_URL", "https://murarkey.com/")."/service-detail"."/".$this->id
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
