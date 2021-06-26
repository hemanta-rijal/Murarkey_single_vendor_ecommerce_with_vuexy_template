<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class BillingDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd($this->billingInfo['country']);
        return $this->billinginfo;
        return [
            // 'country' => $this->billingInfo->country,
            // 'state' => $this->billingInfo->state,
            // 'city' => $this->billinginfo->city,
            // 'specific_address' => $this->billingInfo->specific_address,
            // 'zip' => $this->billingInfo->zip,
        ];
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
