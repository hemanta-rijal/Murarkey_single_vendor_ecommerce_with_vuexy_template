<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd(htmlspecialchars($row['details']));
        // dd(html_entity_decode($row['details']));
        $product = Product::create([

            'name' => strip_tags($row['name']),
            'slug' => Str::slug($row['slug'], '-'),
            'model_number' => $row['model_number'],
            'brand_id' => $row['brand_id'],
            'place_of_origin' => $row['place_of_origin'],
            'details' => htmlspecialchars($row['details']),
            'shipping_details' => htmlspecialchars($row['shipping_details']),
            'packing_details' => htmlspecialchars($row['packing_details']),
            'unit_type' => $row['unit_type'],
            'seller_id' => $row['seller_id'],
            'company_id' => $row['company_id'],
            'featured' => $row['featured'],
            'discount_type' => $row['discount_type'],
            'category_id' => $row['category_id'],
            'status' => $row['status'],
            'deleted_at' => $row['deleted_at'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
            'out_of_stock' => $row['out_of_stock'],
            'assembled_in' => $row['assembled_in'],
            'made_in' => $row['made_in'],
            'price' => $row['price'],
            'size_chart' => $row['size_chart'],
            'a_discount_price' => $row['a_discount_price'],
            'sku' => $row['sku'],
            'total_product_units' => $row['total_product_units'],
        ]);
        // dd($product);
        $images = explode(',', $row['image']);
        if (!empty($images)) {
            foreach ($images as $image) {
                $img = getImageContent($image);
                ProductHasImage::create(['image' => $img, 'product_id' => $product->id]);
            }
        }
        return $product;
    }
}

// 'flat_rate_discount' => $row['flat_rate_discount'],
//  'id' => $row[0],
// 'name' => $row[1],
// 'model_number' => $row[2],
// 'brand_id' => $row[3],
// 'place_of_origin' => $row[4],
// 'details' => $row[5],
// 'shipping_details' => $row[6],
// 'packing_details' => $row[7],
// 'unit_type' => $row[8],
// 'seller_id' => $row[9],
// 'company_id' => $row[10],
// 'featured' => $row[11],
// 'category_id' => $row[12],
// 'status' => $row[13],
// 'deleted_at' => $row[14],
// 'created_at' => $row[15],
// 'updated_at' => $row[16],
// 'out_of_stock' => $row[17],
// 'assembled_in' => $row[18],
// 'made_in' => $row[19],
// 'slug' => $row[20],
// 'price' => $row[21],
// 'flat_rate_discount' => $row[22],
// 'size_chart' => $row[23],
// 'a_discount_price' => $row[24],
// 'discount_type' => $row[25],
