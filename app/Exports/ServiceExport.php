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
            // dd($service->slug);
            return [
                'id' => $service->id,
                'title' => $service->title,
                'slug' => $service->slug,
                'about' => $service->description,
                'min_duration' => $service->min_duration,
                'min_duration_unit' => $service->min_duration_unit,
                'max_duration' => $service->max_duration,
                'max_duration_unit' => $service->max_duration_unit,
                'category_id' => $service->category_id,
                'short_description' => $service->short_description,
                'icon_image' => $service->icon_image,
                'description' => $service->description,
                'popular' => $service->popular,
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
            'id',
            'title',
            'slug',
            'about',
            'min_duration',
            'min_duration_unit',
            'max_duration',
            'max_duration_unit',
            'category_id',
            'short_description',
            'icon_image',
            'description',
            'popular',
            'service_charge',
            'discount_type',
            'a_discount_price',
        ];
    }
}
