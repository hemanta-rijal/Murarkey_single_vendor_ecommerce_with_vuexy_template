<?php

namespace App\Exports;

use App\Models\Service;
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

            // $featured_images = implode(',', URL::asset($service->images->pluck('image')->toArray()));
            return [
                'title' => $service->title,
                'about' => $service->description,
                'min_duration' => $service->min_duration,
                'min_duration_unit' => $service->min_duration_unit,
                'max_duration' => $service->max_duration,
                'max_duration_unit' => $service->max_duration_unit,
                'category_name' => $service->serviceCategory->name,
                'service_quote' => $service->service_quote,
                'short_description' => $service->short_description,
                'icon_image' => resize_image_url($service->icon_image, '50X50'),
                'featured_image' => implode(';', $service->images->pluck('image')->toArray()),
                'description' => $service->description,
                'popular' => $service->popular,
                'serviceTo' => $service->serviceTo,
                'service_charge' => $service->service_charge,
                'discount_type' => $service->discount_type,
                'a_discount_price' => $service->a_discount_price,
            ];
        });

        //feature images
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
            'category_name',
            'service_quote',
            'short_description',
            'icon_image',
            'featured_image',
            'description',
            'popular',
            'serviceTo',
            'service_charge',
            'discount_type',
            'a_discount_price',
        ];
    }
}
