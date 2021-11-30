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
        $parent = null;
        $category_name = null;

        if (isset($row['category_name'])) {
            $category = $this->serviceCategoryService->findBy('name', e($row['category_name']));
            $category_name = $category ? $category->name : e($row['category_name']);
            if (isset($row['sub_category_name'])) {
                $parent = $this->serviceCategoryService->findBy('name', e($row['category_name']));
                $category = $this->serviceCategoryService->findBy('name', e($row['sub_category_name']));
                $category_name = $category ? $category->name : e($row['sub_category_name']);
                if (isset($row['sub_sub_category_name'])) {
                    $parent = $this->serviceCategoryService->findBy('name', e($row['sub_category_name']));
                    $category = $this->serviceCategoryService->findBy('name', e($row['sub_sub_category_name']));
                    $category_name = $category ? $category->name : e($row['sub_sub_category_name']);
                }
            }
        }
        $icon_image = importImageContent($row['icon_image'], 'public/service-categories/');
        $banner_image = importImageContent($row['banner_image'], 'public/service-categories/');
        $data = [
            'name' => $category_name,
            'slug' => Str::slug($row['category_name']),
            'parent_id' => $parent ? $parent->id : null,
            'featured' => $row['featured'] == 1 ? 1 : 0,
            'icon_image' => $icon_image,
            'banner_image' => $banner_image,
        ];
        // dd($data);
        // $categoryExist = $this->serviceCategoryService->findBy('name', e($row['category_name']));
        // if ($categoryExist) {
        //     return $this->serviceCategoryService->update($categoryExist->id, $data);
        // }
        return $this->serviceCategoryService->create($data);

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

}
