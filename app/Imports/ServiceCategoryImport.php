<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Modules\ServiceCategories\Contracts\ServiceCategoryService;
use Throwable;

class ServiceCategoryImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation
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

        //insert first level of category
        if ($row['category_name'] != null && $row['sub_category_name'] == null && $row['sub_sub_category_name'] == null) {
            return $this->handleFirstLevelCategoryData($row);
        }
        // insert second level of category
        if ($row['category_name'] != null && $row['sub_category_name'] != null && $row['sub_sub_category_name'] == null) {
            return $this->handleSecondLevelCategoryData($row);
        }
        //insert third level of category
        if ($row['category_name'] != null && $row['sub_category_name'] != null && $row['sub_sub_category_name'] != null) {
            return $this->handleThirdLevelCategoryData($row);
        }
    }

    public function onError(Throwable $error)
    {
        return $error->getMessage();
    }

    public function rules(): array
    {
        return [
            '*.slug' => ['string', 'unique:service_categories,slug'],
        ];
    }

    public function thirdLevelCategoryData($row, $parent_id)
    {
        $icon_image = importImageContent($row['icon_image'], 'public/service-categories/');
        $banner_image = importImageContent($row['banner_image'], 'public/service-categories/');
        return $data = [
            'name' => e($row['sub_sub_category_name']),
            'slug' => Str::slug(e($row['sub_sub_category_name'])),
            'parent_id' => $parent_id,
            'featured' => $row['featured'] == 1 ? 1 : 0,
            'icon_image' => $icon_image,
            'banner_image' => $banner_image,
        ];
    }

    public function handleFirstLevelCategoryData($row)
    {
        //check if cateory exist or not
        $firstLevelCategory = $this->serviceCategoryService->findBy('name', e($row['category_name']));
        if (!$firstLevelCategory) {
            return $this->serviceCategoryService->create($this->firstLevelCategoryData($row));
        } else {
            $this->serviceCategoryService->update($firstLevelCategory->id, $this->firstLevelCategoryData($row));
            return $this->serviceCategoryService->findBy('name', e($row['category_name']))->first();
        }
    }
    public function firstLevelCategoryData($row)
    {
        $icon_image = importImageContent($row['icon_image'], 'public/service-categories/');
        $banner_image = importImageContent($row['banner_image'], 'public/service-categories/');
        return $data = [
            'name' => e($row['category_name']),
            'slug' => Str::slug(e($row['category_name'])),
            'parent_id' => null,
            'featured' => $row['featured'] == 1 ? 1 : 0,
            'icon_image' => $icon_image,
            'banner_image' => $banner_image,
        ];
    }

    public function handleSecondLevelCategoryData($row)
    {
        //skip if its parent not present
        $parentCategory = $this->serviceCategoryService->findBy('name', e($row['category_name']));
        if ($parentCategory) {
            //check if category exist or not
            $secondLevelCategory = $this->serviceCategoryService->findBy('name', e($row['sub_category_name']));
            if (!$secondLevelCategory) {
                return $this->serviceCategoryService->create($this->secondLevelCategoryData($row, $parentCategory->id));
            } else {
                $this->serviceCategoryService->update($secondLevelCategory->id, $this->secondLevelCategoryData($row, $parentCategory->id));
                return $this->serviceCategoryService->findBy('name', e($row['sub_category_name']))->first();
            }
        }
    }
    public function secondLevelCategoryData($row, $parent_id)
    {
        $icon_image = importImageContent($row['icon_image'], 'public/service-categories/');
        $banner_image = importImageContent($row['banner_image'], 'public/service-categories/');

        return $data = [
            'name' => e($row['sub_category_name']),
            'slug' => Str::slug(e($row['sub_category_name'])),
            'parent_id' => $parent_id,
            'featured' => $row['featured'] == 1 ? 1 : 0,
            'icon_image' => $icon_image,
            'banner_image' => $banner_image,
        ];
    }
    public function handleThirdLevelCategoryData($row)
    {
        //skip if its parent not present
        $parentCategory = $this->serviceCategoryService->findBy('name', e($row['sub_category_name']));
        if ($parentCategory) {
            //check if category exist or not
            $thirdLevelCateogry = $this->serviceCategoryService->findBy('name', e($row['sub_sub_category_name']));
            if (!$thirdLevelCateogry) {
                return $this->serviceCategoryService->create($this->thirdLevelCategoryData($row, $parentCategory->id));
            } else {
                $this->serviceCategoryService->update($thirdLevelCateogry->id, $this->thirdLevelCategoryData($row, $parentCategory->id));
                return $this->serviceCategoryService->findBy('name', e($row['sub_sub_category_name']))->first();
            }
        }
    }

}
