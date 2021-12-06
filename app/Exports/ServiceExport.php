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
            return [
                'title' => $service->title,
                'min_duration' => $service->min_duration,
                'min_duration_unit' => $service->min_duration_unit,
                'max_duration' => $service->max_duration,
                'max_duration_unit' => $service->max_duration_unit,
                'category' => $service->serviceCategory ? $service->serviceCategory->name : null,
                'service_quote' => $service->service_quote,
                'short_description' => $service->short_description,
                'description' => $service->description,
                'icon_image' => resize_image_url($service->icon_image, '50X50'),
                'featured_images' => implode(';', $service->images->pluck('image')->toArray()),
                'popular' => $service->popular ? 1 : 0,
                'serviceTo' => $service->serviceTo,
                'service_charge' => $service->service_charge,
                'discount_type' => $service->discount_type,
                'discount_rates' => $service->discount_rates,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'title',
            'min_duration',
            'min_duration_unit',
            'max_duration',
            'max_duration_unit',
            'category',
            'service_quote',
            'short_description',
            'description',
            'icon_image',
            'featured_images',
            'popular',
            'serviceTo',
            'service_charge',
            'discount_type',
            'discount_rates',
        ];
    }
}
