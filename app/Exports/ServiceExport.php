<?php

namespace App\Exports;

use App\Models\Service;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Service::all()->map(function ($service) {
            return [
                'title' => $service->title,
                'about' => $service->description,
                'min_duration' => $service->min_duration,
                'min_duration_unit' => $service->min_duration_unit,
                'max_duration' => $service->max_duration,
                'max_duration_unit' => $service->max_duration_unit,
                'category' => $service->serviceCategory ? $service->serviceCategory->name : null,
                'service_quote' => $service->service_quote,
                'short_description' => $service->short_description,
                'icon_image' => resize_image_url($service->icon_image, '50X50'),
                'featured_images' => implode(',',array_map(function ($image) {
                    return map_storage_path_to_link($image);
                }, $service->images->pluck('image')->toArray())),
                'description' => $service->description,
                'popular' => $service->popular ? 1 : 0,
                'serviceTo' => $service->serviceTo,
                'service_charge' => $service->service_charge,
                'discount_type' => $service->discount_type,
                'a_discount_price' => $service->a_discount_price,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'title',
            'about',
            'min_duration',
            'min_duration_unit',
            'max_duration',
            'max_duration_unit',
            'category',
            'service_quote',
            'short_description',
            'icon_image',
            'featured_images',
            'description',
            'popular',
            'serviceTo',
            'service_charge',
            'discount_type',
            'a_discount_price',
        ];
    }

}
