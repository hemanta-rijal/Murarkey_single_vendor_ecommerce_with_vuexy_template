<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromCollection;

class BrandsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return Brand::all();

        return Brand::all()->map(function ($brand) {
            return [
                'id' => $brand->id,
                'name' => $brand->name,
                'slug' => $brand->slug,
            ];
        });

    }
}
