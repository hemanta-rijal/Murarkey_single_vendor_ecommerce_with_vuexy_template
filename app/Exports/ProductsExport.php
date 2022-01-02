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
                'category' => $product->category ? $product->category->name : null,
                'brand' => $product->brand? $product->brand->name:'',
                'details' => $product->details,
                'unit_type' => $product->unit_type,
                'featured' => $product->featured ? 1 : 0,
                'status' => $product->status,
                'out_of_stock' => $product->out_of_stock,
                'price' => $product->price,
                'discount_type' => $product->discount_type,
                'discount_rates' => $product->discount_rates,
                'image' => implode(',',array_map(function ($image) {
                    return map_storage_path_to_link($image);
                }, $product->images->pluck('image')->toArray())),
                'sku' => $product->sku,
                'total_product_units' => $product->total_product_units,
                'skin_tone' => $product->skin_tone,
                'skin_concern' => $product->skin_concern,
                'product_type' => $product->product_type,
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
            'Status',
            'Out Of Stock',
            'Price',
            'Discount Type',
            'Discount Rates',
            'Image',
            'SKU',
            'Total Product Units',
            'Skin Tone',
            'Skin Concern',
            'Product Type'
        ];
    }
}
