<?php

namespace App\Imports;

use App\Models\ServiceCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\ServiceCategories\Contracts\ServiceCategoryService;
use Throwable;

class ServiceCategoryImport implements ToModel, WithHeadingRow, SkipsOnError
{

    use Importable, SkipsErrors;
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
                $parent = $this->serviceCategoryService->findBySlug(Str::slug($row['parent_category']));
                $parent = $parent ? $parent->id : null;
            }
            $icon_image = importImageContent($row['icon_image'], 'public/service-categories/');
            $banner_image = importImageContent($row['banner_image'], 'public/service-categories/');
            if ($icon_image && $banner_image) {
                $serviceCategory = ServiceCategory::create([
                    'name' => $row['name'],
                    'slug' => $row['slug'],
                    'parent_id' => $parent,
                    // 'featured' => $row['featured'] == 1 ? 1 : 0,
                    'icon_image' => $icon_image,
                    'banner_image' => $banner_image,
                ]);
                return $serviceCategory;
            }

        }

    }

    public function onError(Throwable $error)
    {
    }

}
