<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([

            'id' => $row[0],
            'name' => $row[1],
            'model_number' => $row[2],
            'brand_id' => $row[3],
            'place_of_origin' => $row[4],
            'details' => $row[5],
            'shipping_details' => $row[6],
            'packing_details' => $row[7],
            'unit_type' => $row[8],
            'seller_id' => $row[9],
            'company_id' => $row[10],
            'featured' => $row[11],
            'category_id' => $row[12],
            'status' => $row[13],
            'deleted_at' => $row[14],
            'created_at' => $row[15],
            'updated_at' => $row[16],
            'out_of_stock' => $row[17],
            'assembled_in' => $row[18],
            'made_in' => $row[19],
            'slug' => $row[20],
            'price' => $row[21],
            'flat_rate_discount' => $row[22],
            'size_chart' => $row[23],
            'a_discount_price' => $row[24],
            'discount_type' => $row[25],
        ]);
    }
}
