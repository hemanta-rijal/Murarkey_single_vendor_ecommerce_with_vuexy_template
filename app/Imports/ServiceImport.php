<?php

namespace App\Imports;

use App\Models\Service;
use App\Models\ServiceHasImage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;
use Modules\ServiceCategories\Contracts\ServiceCategoryService;
use Modules\Service\Contracts\ServiceService;
use Throwable;

class ServiceImport implements ToModel, WithHeadingRow, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors;

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
        if (isset($row['title'])) {
            $slug = Str::slug($row['title'], '-');
            $serviceExist = $this->serviceService->findBySlug($slug);
            if ($serviceExist->count() == 0) {
                $uploaded_contents = [];
                $images = explode(';', $row['featured_images']);
                if (!empty($images)) {
                    foreach ($images as $image) {
                        $img = importImageContent($image, 'public/services/');
                        $img != false ? $uploaded_contents[] = $img : '';
                    }
                }
                $icon_image = importImageContent($row['icon_image'], 'public/services/');
                if (!empty($uploaded_contents) && $icon_image) {
                    if (isset($row['sub_sub_category'])) {
                        $category = $this->serviceCategoryService->findBySlug(Str::slug($row['sub_sub_category']));
                        $category_id = $category ? $category->id : $this->serviceCategoryService->getThirdLevelCategories()[0]->id;
                        if ($category_id) {
                            $service = Service::create([
                                'title' => strip_tags($row['title']),
                                'slug' => $slug,
                                'about' => htmlspecialchars($row['about']),
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
                            ]);
                            $service_images = [];

                            if (!empty($uploaded_contents)) {
                                foreach ($uploaded_contents as $upload) {
                                    $upload = importImageContent($image, 'public/services/');
                                    $service_images[] = new ServiceHasImage(['image' => $upload]);
                                }
                            }

                            $service->images()->saveMany($service_images);
                            return $service;
                        }
                    }
                }
            }
        }
    }

    public function onError(Throwable $error)
    {
        return $error->getMessage();
    }

    public function onFailure(Failure...$failure)
    {
        # code...
    }
}
