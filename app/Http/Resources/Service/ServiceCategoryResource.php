<?php

namespace App\Http\Resources\Service;

use App\Http\Resources\Service\ServiceCategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd($this->icon_image);
        return [
            'id' => $this->id,
            'name' => $this->name,
            // 'parent_id' => $this->parent_id,
            // 'featured' => $this->featured,
            // 'slug' => $this->slug,
            'icon' => resize_image_url($this->icon_image, '100X100'),
            // 'banner_image' => resize_image_url($this->banner_image, '600X600'),
            // 'description' => $this->description,
            // 'service_count'=>$this->service_count,
            'child' => ServiceCategoryResource::collection($this->child_category),
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
