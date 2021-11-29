<?php

namespace App\Exports;

use App\Models\ServiceCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\ServiceCategories\Contracts\ServiceCategoryService;

class ServiceCategoryExport implements FromCollection, WithHeadings
{

    protected $serviceCategoryService;

    public function __construct(ServiceCategoryService $CategoryService)
    {
        $this->serviceCategoryService = $CategoryService;

    }

    public function collection()
    {
        return ServiceCategory::all()->map(function ($category) {

            $category_name = $category->name;
            $sub_category_name = null;
            $sub_sub_category_name = null;
            // dd($this->serviceCategoryService->getChildren($category->id));
            if ($category->parent_id) {
                $category_name = $category->parent_category->name;
                $sub_category_name = $category->name;
                $sub_sub_category_name = null;

                if ($category->parent_category->parent_id) {
                    $category_name = $category->parent_category->parent_category->name;
                    $sub_category_name = $category->parent_category->name;
                    $sub_sub_category_name = $category->name;
                }

            }

            return [
                'category name' => $category_name,
                'Sub category name' => $sub_category_name,
                'sub sub category name' => $sub_sub_category_name,
                'featured' => $category->featured == 1 ? 1 : 0,
                'icon_image' => resize_image_url($category->icon_image, '100X100'),
                'banner_image' => resize_image_url($category->banner_image, '600X600'),
            ];
        });

    }

    public function headings(): array
    {
        return [
            'Category Name',
            'Sub Category Name',
            'Sub Sub Category Name',
            'Featured',
            'Icon Image',
            'Banner Image',
        ];
    }
}
