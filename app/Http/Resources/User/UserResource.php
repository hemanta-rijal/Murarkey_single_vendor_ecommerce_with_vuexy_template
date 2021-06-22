<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class UserResource extends JsonResource
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
            'name' => $this->first_name . ' ' . $this->last_name,
            'role' => $this->role,
            'email' => $this->email,
            'phone' => $this->phone_number,
            'status' => $this->status ? 'verified' : 'un-verified',
            'billing_address'=> $this->billing_address!=null ? array_map(function ($value) {
                return (array)$value;
            }, $this->billing_address): null,
            'profileImage' => $this->profile_pic ? URL::asset($this->profile_pic) : null,
            'joined_on' => $this->created_at->format('d, M-Y'),
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
