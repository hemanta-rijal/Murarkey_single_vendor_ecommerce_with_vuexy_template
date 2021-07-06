<?php

namespace Modules\ServiceCategories\Requests;

use App\Http\Requests\BaseRequest;

class UpdateServiceCategoryRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',

            'slug' => 'unique:categories,slug,' . $this->route('category'),
        ];
    }
}
