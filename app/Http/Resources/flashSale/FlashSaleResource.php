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
            "start_time" => $this->start_time->format('d,M-Y'),
            "end_time" => $this->end_time->format('d,M-Y'),
            "weight" => 1,
            "published" => 1,
            "created_at" => "2020-10-30T10=>36=>45.000000Z",
            "updated_at" => "2021-05-28T09=>56=>52.000000Z",
            "items" => [],
        ];
    }
}
