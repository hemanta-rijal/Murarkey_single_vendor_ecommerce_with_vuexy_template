<?php

namespace Modules\ServiceCategories\Requests;

use App\Http\Requests\BaseRequest;

class CreateServiceCategoryRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'icon_path' => 'image',
            'image_path' => 'image',
            'slug' => 'unique:categories,slug',
        ];
    }
}
