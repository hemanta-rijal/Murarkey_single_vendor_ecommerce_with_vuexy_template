<?php

namespace App\Imports;

use App\Models\ServiceCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\ServiceCategories\Contracts\ServiceCategoryService;

class ServiceCategoryImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */

    protected $serviceCategoryService;

    public function __construct(ServiceCategoryService $CategoryService)
    {
        $this->serviceCategoryService = $CategoryService;

    }
    public function model(array $row)
    {
        $categoryExist = $this->serviceCategoryService->findBySlug(Str::slug($row['slug']));
        if (!$categoryExist) {
            $parent = null;
            if (isset($row['parent_category'])) {
                // dd($row['parent_category']);
                $parent = $this->serviceCategoryService->findBySlug(Str::slug($row['parent_category']))->id;
                // dd($parent);
            }
            $icon_image = uploadServiceCategoryImageContent($row['icon_image']);
            $banner_image = uploadServiceCategoryImageContent($row['banner_image']);

            $serviceCategory = ServiceCategory::create([
                'name' => $row['name'],
                'slug' => $row['slug'],
                'parent_id' => $parent,
                'featured' => $row['featured'],
                'icon_image' => $icon_image,
                'banner_image' => $banner_image,
            ]);
            // dd($serviceCategory);
            return $serviceCategory;
        }
    }

}
