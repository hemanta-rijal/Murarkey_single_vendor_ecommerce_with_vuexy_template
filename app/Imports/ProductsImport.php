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

        $name = strip_tags($row['name']);
        $slug = Str::slug($name);
        $productExist = $this->productService->findBySlug($slug);
        if (!$productExist) {

            $uploaded_contents = [];
            $images = explode(',', $row['image']);
            if (!empty($images)) {
                foreach ($images as $image) {
                    $img = ImportImageContent($image, 'public/products/');
                    $img != false ? $uploaded_contents[] = $img : '';
                }
            }
            if (!empty($uploaded_contents)) {

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

                if (!empty($uploaded_contents)) {
                    foreach ($uploaded_contents as $upload) {
                        ProductHasImage::create(['image' => $upload, 'product_id' => $product->id]);
                    }
                }

                return $product;
            }
        }
    }

    public function onFailure(Failure...$failures)
    {
        // Handle the failures how you'd like.
    }
}
