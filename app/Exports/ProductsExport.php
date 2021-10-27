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
        // return Product::all();
        return Product::all()->map(function ($product) {
            return [
                'name' => $product->name,
                // 'slug' => $product->slug,
                // 'model_number' => $product->model_number, //nullable
                'brand_name' => $product->name,
                // 'place_of_origin' => $product->place_of_origin, //nullable
                'details' => $product->details,
                // 'shipping_details' => $product->shipping_details,
                // 'packing_details' => $product->packing_details,
                'unit_type' => $product->unit_type,
                // 'seller_id' => $product->seller_id,
                // 'company_id' => $product->company_id,
                'featured' => $product->featured,
                'category_name' => $product->category ? $product->category->name : null,
                'status' => $product->status,
                'out_of_stock' => $product->out_of_stock,
                // 'assembled_in' => $product->assembled_in,
                // 'made_in' => $product->made_in,
                'price' => $product->price,
                // 'size_chart' => $product->size_chart,
                'discount_type' => $product->discount_type,
                'a_discount_price' => $product->a_discount_price,
                'image' => URL::asset(map_storage_path_to_link($product->images->first()->image)),
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
            // 'Model Number',
            'Brand Name',
            // 'Place Of Origin',
            'Details',
            // 'Shipping Details',
            // 'Packing Details',
            'Unit Type',
            // 'Seller Id',
            // 'Company Id',
            'Featured',
            'Discount Type',
            'Category Name',
            'Status',
            'Out Of Stock',
            // 'Assembled In',
            // 'Made In',
            'Price',
            // 'Size Chart',
            'A Discount Price',
            'Image',
            'SKU',
            'Total Product Units',
            'Skin Tone',
        ];
    }
}
