<?php

namespace App\Exports;

use App\Models\ParlourListing;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParlourListingExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ParlourListing::all()->map(function ($parlour) {
            return [
                'name' => $parlour->name,
                'slug' => $parlour->slug,
                'address' => $parlour->address,
                'about' => $parlour->about,
                'category_id' => $parlour->category_id,
                'feature_image' => URL::asset(map_storage_path_to_link($parlour->feature_image)),
                'featured' => $parlour->featured,
            ];
        });

    }

    public function headings(): array
    {
        return [
            'name',
            'slug',
            'address',
            'about',
            'category_id',
            'feature_image',
            'featured',
        ];
    }
}
