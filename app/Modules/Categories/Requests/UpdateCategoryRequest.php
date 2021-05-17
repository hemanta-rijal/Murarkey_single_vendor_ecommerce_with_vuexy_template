<?php


namespace Modules\Categories\Requests;


use App\Http\Requests\BaseRequest;

class UpdateCategoryRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',

            'slug' => 'unique:categories,slug,' . $this->route('category')
        ];
    }
}