<?php

namespace App\Http\Resources\flashSale;

use Illuminate\Http\Resources\Json\JsonResource;

class FlashSaleResource extends JsonResource
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
            "title" => $this->title,
            "startTime" => $this->start_time->format('d,M-Y'),
            "endTime" => $this->end_time->format('d,M-Y'),
            "weight" => $this->weight,
            "published" => $this->published ? 'published' : 'un-published',
            "created_at" => $this->created_at->format('d,M-Y'),
            "items" => FlashSaleItemResource::collection($this->items),
        ];
    }
}
