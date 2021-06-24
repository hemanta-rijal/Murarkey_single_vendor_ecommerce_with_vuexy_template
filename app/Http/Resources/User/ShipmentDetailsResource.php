<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->shipmentinfo;
        // return [
        //     'country' => $this->shipmentinfo->country,
        //     'state' => $this->shipmentinfo->state,
        //     'city' => $this->shipmentinfo->city,
        //     'specific_address' => $this->shipmentinfo->specific_address,
        //     'zip' => $this->shipmentinfo->zip,
        // ];

    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200,
            'message' => 'successfully fetched',
        ];
    }
}
