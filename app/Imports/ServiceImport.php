<?php

namespace App\Imports;

use App\Models\Service;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\ServiceCategories\Contracts\ServiceCategoryService;
use Modules\Service\Contracts\ServiceService;

class ServiceImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $serviceService;
    protected $serviceCategoryService;

    public function __construct(ServiceService $service, ServiceCategoryService $CategoryService)
    {
        $this->serviceService = $service;
        $this->serviceCategoryService = $CategoryService;

    }

    public function model(array $row)
    {
        $slug = Str::slug($row['title'], '-');
        $serviceExist = $this->serviceService->findBySlug($slug);
        // dd($serviceExist);
        if ($serviceExist->count() == 0) {
            if (isset($row['sub-sub-category'])) {
                $category_id = $this->findRelatedCategory($row['sub-sub-category']);
                dd($category_id);
                if ($category_id) {
                    $icon_image = getImageContent($row['icon_image']);
                    $service = Service::create([
                        'title' => strip_tags($row['title']),
                        'slug' => Str::slug($row['title'], '-'),
                        'about' => htmlspecialchars($row['about']),
                        'min_duration' => $row['min_duration'],
                        'min_duration_unit' => $row['min_duration_unit'],
                        'max_duration' => $row['max_duration'],
                        'max_duration_unit' => $row['max_duration_unit'],
                        'category_id' => $row['category_id'],
                        'short_description' => $row['short_description'],
                        'icon_image' => $icon_image ?? null,
                        'description' => $row['description'],
                        'popular' => $row['popular'],
                        'service_charge' => $row['service_charge'],
                        'discount_type' => $row['discount_type'],
                        'a_discount_price' => $row['a_discount_price'],
                    ]);
                    dd($service);
                    return $service;
                }
            }

        }
        // abort(503);
        // return false;
        // for feature images
    }

    public function findRelatedCategory($category)
    {

    }
}
