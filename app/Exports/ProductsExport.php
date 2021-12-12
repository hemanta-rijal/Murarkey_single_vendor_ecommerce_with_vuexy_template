<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::all()->map(function ($product) {
            return [
                'name' => $product->name,
                'brand' => $product->brand? $product->brand->name:'',
                'details' => $product->details,
                'unit_type' => $product->unit_type,
                'featured' => $product->featured ? 1 : 0,
                'category' => $product->category ? $product->category->name : null,
                'status' => $product->status,
                'out_of_stock' => $product->out_of_stock,
                'price' => $product->price,
                'discount_type' => $product->discount_type,
                'discount_rates' => $product->discount_rates,
                'image' => URL::asset(map_storage_path_to_link($product->images->first()->image)),
                'sku' => $product->sku,
                'total_product_units' => $product->total_product_units,
                'skin_tone' => $product->skin_tone,
            ];
        });

    }

    public function headings(): array
    {
        return [
            'Name',
            'Category',
            'Brand',
            'Details',
            'Unit Type',
            'Featured',
            'Discount Type',
            'Status',
            'Out Of Stock',
            'Price',
            'Discount Rates',
            'Image',
            'SKU',
            'Total Product Units',
            'Skin Tone',
        ];
    }
}
