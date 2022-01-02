<?php

namespace App\Imports;

use App\Models\ServiceHasImage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\ServiceCategories\Contracts\ServiceCategoryService;
use Modules\Service\Contracts\ServiceService;

class ServiceImport implements ToModel, WithHeadingRow
{
    use Importable;

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

        $category = $this->serviceCategoryService->findBy('name', e($row['category']));

        //check if category is in third level
        if ($category && in_array($category->id, collect($this->serviceCategoryService->getThirdLevelCategories())->pluck('id')->toArray())) {
            //images upload
            $uploaded_contents = $this->uploadServiceImages($row['featured_images']);

            $icon_image = importImageContent($row['icon_image'], 'public/services/');

            $data = $this->setData($row, $icon_image, $category->id);
            $service = $this->serviceService->findBy('title', e($row['title']));

            if (!$service) {
                $createService = $this->serviceService->create($data);
                // sote images to service has images (pivote table)
                $service_images = $this->storeImagesToServiceHasImages($createService, $uploaded_contents);
                return $createService;
            } else {
                $updateService = $this->serviceService->update($service->id, $data);
                $this->storeImagesToServiceHasImages($service, $uploaded_contents);
                return $service;
            }

        }
    }

    public function setData($row, $icon_image, $category_id)
    {
        // dd($row)
        return [
            'title' => e($row['title']),
            'slug' => Str::slug(e($row['title'])),
            'about' => input_filter($row['about']),
            'min_duration' => $row['min_duration'],
            'min_duration_unit' => $row['min_duration_unit'],
            'max_duration' => $row['max_duration'],
            'max_duration_unit' => $row['max_duration_unit'],
            'category_id' => $category_id,
            'service_quote' => $row['service_quote'],
            'short_description' => $row['short_description'],
            'icon_image' => $icon_image ?? null,
            'description' => $row['description'],
            'popular' => $row['popular'],
            'serviceTo' => $row['serviceto'],
            'service_charge' => $row['service_charge'],
            'discount_type' => $row['discount_type'],
            'a_discount_price' => $row['a_discount_price'],
        ];
    }

    public function uploadServiceImages($featured_images)
    {
        //images upload
        $uploaded_contents = [];
        $images = explode(',', $featured_images);
        if (!empty($images)) {
            foreach ($images as $image) {
                $img = importImageContent($image, 'public/services/');
                $img != false ? $uploaded_contents[] = $img : '';
            }
        }
        return $uploaded_contents;

    }

    public function storeImagesToServiceHasImages($service, $uploaded_contents)
    {
        $service_images = [];
        if (!empty($uploaded_contents)) {
            foreach ($uploaded_contents as $upload) {
                $service_images[] = new ServiceHasImage(['image' => $upload]);
            }
        }
        $service->images()->saveMany($service_images);

    }
}
