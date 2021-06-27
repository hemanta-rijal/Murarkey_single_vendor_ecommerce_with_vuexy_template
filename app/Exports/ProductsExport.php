<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::all();
        // return Product::all()->map(function ($product) {
        //     return [
        //         'id' => $product->id,
        //         'name' => $product->name,
        //         'slug' => $product->slug,
        //     ];
        // });

    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Model Number',
            'Brand Id',
            'Place Of Origin',
            'Details',
            'Shipping Details',
            'Packing Details',
            'Unit Type',
            'Seller Id',
            'Company Id',
            'Featured',
            'Category Id',
            'Status',
            'Deleted At',
            'Created At',
            'Updated At',
            'Out Of Stock',
            'Assembled In',
            'Made In',
            'Slug',
            'Price',
            'Flat Rate Discount',
            'Size Chart',
            'A Discount Price',
            'Discount Type',
        ];
    }
}
