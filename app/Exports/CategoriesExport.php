<?php

namespace App\Exports;

use App\Models\Category;
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
            return [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
            ];

        });

    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Slug',
        ];
    }
}
