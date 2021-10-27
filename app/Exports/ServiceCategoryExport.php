<?php

namespace App\Exports;

use App\Models\ServiceCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceCategoryExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ServiceCategory::all()->map(function ($category) {

            // $featured_images = implode(',', URL::asset($service->images->pluck('image')->toArray()));
            // dd($featured_images);
            $parent = null;
            if ($category->parent_category !== null) {
                $parent = $category->parent_category->slug;
            }
            return [
                'name' => $category->name,
                'slug' => $category->slug,
                'parent' => $parent,
                'featured' => $category->featured == 1 ? 1 : 0,
                'icon_image' => resize_image_url($category->icon_image, '100X100'),
                'banner_image' => resize_image_url($category->banner_image, '600X600'),
            ];
        });

    }

    public function headings(): array
    {
        return [
            'name',
            'slug',
            'parent_category',
            'featured',
            'icon_image',
            'banner_image',
        ];
    }
}
