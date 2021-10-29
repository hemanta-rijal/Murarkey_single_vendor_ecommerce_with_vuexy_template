<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductHasImage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Brand\Services\BrandService;
use Modules\Categories\Contracts\CategoryService;
use Modules\Products\Contracts\ProductService;

class ProductsImport implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $productService;
    protected $categoryService;
    protected $brandService;

    public function __construct(ProductService $productService, CategoryService $categoryService, BrandService $brandService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
    }

    public function model(array $row)
    {
        // help if needer for later;
        // dd(htmlspecialchars($row['details']));
        // dd(html_entity_decode($row['details']));
        $name = strip_tags($row['name']);
        $slug = Str::slug($name);
        $productExist = $this->productService->findBySlug($slug);
        if (!$productExist) {
            $brand = $this->brandService->findBySlug(Str::slug($row['brand_name']));
            $category = $this->categoryService->getBySlug(Str::slug($row['category_name']));
            $product = Product::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'brand_id' => $brand ? $brand->id : $this->brandService->getAll()->first()->id,
                'details' => htmlspecialchars($row['details']),
                'unit_type' => $row['unit_type'],
                'featured' => $row['featured'] ? 1 : 0,
                'discount_type' => $row['discount_type'],
                'category_id' => $category ? $category->id : $this->categoryService->getAll()->first()->id,
                'status' => $row['status'],
                'out_of_stock' => $row['out_of_stock'] == 1 ? 1 : 0,
                'price' => $row['price'],
                'a_discount_price' => $row['a_discount_price'],
                'sku' => $row['sku'],
                'total_product_units' => $row['total_product_units'],
            ]);
            $images = explode(',', $row['image']);
            if (!empty($images)) {
                foreach ($images as $image) {
                    $img = ImportImageContent($image, 'public/products/');
                    ProductHasImage::create(['image' => $img, 'product_id' => $product->id]);
                }
            }
            return $product;
        }
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
