<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BrandsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Brand::all()->map(function ($brand) {
            return [
                'name' => $brand->name,
                'image' => resize_image_url($brand->image, '600X600'),
                'description' => $brand->description,
            ];
        });

    }
    public function headings(): array
    {
        return [
            'Name',
            'Image',
            'Description',
        ];
    }
}
