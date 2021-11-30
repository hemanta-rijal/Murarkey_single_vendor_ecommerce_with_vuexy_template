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
                'brand_name' => $product->brand->name,
                'details' => $product->details,
                'unit_type' => $product->unit_type,
                'discount_type' => $product->discount_type,
                'featured' => $product->featured ? 1 : 0,
                'category_name' => $product->category ? $product->category->name : null,
                'status' => $product->status,
                'out_of_stock' => $product->out_of_stock,
                'price' => $product->price,
                'a_discount_price' => $product->a_discount_price,
                'image' => URL::asset(map_storage_path_to_link($product->images->first()->image)),
                // 'image' => implode(';', $product->images->pluck('image')->toArray()),
                // 'image' => resize_image_url($product->images->first()->image, '600X600'),
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
            'Brand Name',
            'Details',
            'Unit Type',
            'Featured',
            'Discount Type',
            'Category Name',
            'Status',
            'Out Of Stock',
            'Price',
            'A Discount Price',
            'Image',
            'SKU',
            'Total Product Units',
            'Skin Tone',
        ];
    }
}
