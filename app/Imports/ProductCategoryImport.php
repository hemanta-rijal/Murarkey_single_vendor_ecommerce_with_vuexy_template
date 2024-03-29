<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Categories\Contracts\CategoryService;

class ProductCategoryImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;

    }
    public function model(array $row)
    {

        // $parent = null;
        // if (isset($row['parent_category'])) {
        //     $parent = $this->categoryService->findBy(e($row['parent_category']));
        //     $parent = $parent ? $parent->id : null;
        // }

        $icon_path = importImageContent($row['icon_path'], 'public/service-categories/');
        $image_path = importImageContent($row['image_path'], 'public/service-categories/');

        $data = [
            'name' => e($row['name']),
            'slug' => Str::slug(e($row['name'])),
            // 'parent_id' => $parent,
            'icon_path' => $icon_path,
            'image_path' => $image_path,
            'featured' => $row['featured'] == 1 ? 1 : 0,
            'description' => $row['description'],
        ];

        $category = $this->categoryService->getBySlug(Str::slug(e($row['name'])));
        if (!$category) {
            $productCategory = Category::create($data);
            return $productCategory;
        } else {
            $this->categoryService->update($category->id, $data);
            return $category;
        }
    }

}
