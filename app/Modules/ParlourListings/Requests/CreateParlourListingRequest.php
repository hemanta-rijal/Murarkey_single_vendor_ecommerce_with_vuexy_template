<?php

namespace Modules\ParlourListings\Requests;

use Illuminate\Foundation\Http\FormRequest;

// use App\Http\Requests\BaseRequest;

class CreateParlourListingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:4|max:100',
            'slug' => 'required|string|min:4|max:100|unique:parlour_listings,slug',
            'address' => 'required|string|min:4|max:100',
            'about' => 'string|required|min:10',
            // 'featured_image' => 'image|required|mimes:jpeg,bmp,jpg,png',
            // 'caption' => 'string|max:300',
            // 'status'=>'required|boolean',
            // 'featured'=>'required|boolean',
            // 'email' => 'email|string|min:4|max:100',
            // 'facebook' => 'string|min:4|max:100',
            // 'twitter' => 'string|min:4|max:100',
            // 'instgram' => 'string|min:4|max:100',
            // 'youtube' => 'string|min:4|max:100',
            // 'website' => 'string|min:4|max:100',
        ];
    }
}
