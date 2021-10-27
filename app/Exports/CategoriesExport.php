<?php

namespace App\Exports;

use App\Models\Category;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        // dd(Category::all());
        // return Category::all();

        return Category::all()->map(function ($category) {
            // return
            // dd($category->parent_category);
            return [
                'name' => $category->name,
                'parent_category' => $category->parent_category ? $category->parent_category->name : null,
                'icon_path' => URL::asset(map_storage_path_to_link($category->icon_path)),
                'image_path' => URL::asset(map_storage_path_to_link($category->image_path)),
                'featured' => $category->featured,
                'description' => $category->description,
            ];

        });

    }

    public function headings(): array
    {
        return [
            'Name',
            'Parent Category',
            'Icon Path',
            'Image Path',
            'Featured',
            'Description',
        ];
    }
}
