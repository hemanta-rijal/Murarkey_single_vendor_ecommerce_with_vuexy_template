<?php

namespace App\Http\Resources\Banner;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BannerResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
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
