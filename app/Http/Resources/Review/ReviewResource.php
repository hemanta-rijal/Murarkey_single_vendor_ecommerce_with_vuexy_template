<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class ReviewResource extends JsonResource
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
            'user'=> $this->userDetail($this->user),
            'rating'=>$this->rating,
            'comment'=>$this->comment
        ];
    }

    public function userDetail($user){
        return [
            'name' => $user->first_name . ' ' . $user->last_name,
            'profileImage' => $user->profile_pic ? URL::asset($user->profile_pic) : null
        ];
    }
}
