<?php

namespace App\Http\Resources\Service;

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
            'short_description' => $this->short_description,
            'description' => $this->description,
            'service_charge' => $this->service_charge,
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
