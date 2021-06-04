<?php

namespace App\Http\Resources\User;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'id'=>$this->id,
            'name'=>$this->first_name.' '.$this->last_name,
            'role'=>$this->role,
            'email'=>$this->email,
            'phone'=>$this->phone_number,
            'status'=>$this->status ? 'verified' : 'un-verified',
            'profileImage'=>$this->profile_pic ? URL::asset($this->profile_pic) : null,
            'joined_on'=>$this->created_at->format('d, M-Y')
        ];
    }
}
