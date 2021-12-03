<?php

namespace App\Imports;

use App\Models\ProductHasImage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Brand\Services\BrandService;
use Modules\Categories\Contracts\CategoryService;
use Modules\Products\Contracts\ProductService;

class ProductsImport implements ToModel, WithHeadingRow
{
    use Importable;

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
        $name = e($row['name']);
        $slug = Str::slug($name);

        $brand = $this->brandService->findBy('name', e($row['brand']));
        $category = $this->categoryService->findBy('name', e($row['category']));

        if ($brand && $category) {
            $uploaded_contents = $this->storeProductImages($row['image']);
            $data = $this->setData($row, $category, $brand);

            $product = $this->productService->findBy('name', $name);
            if (!$product) {
                // create
                $create_product = $this->productService->create($data);
                $product_images = $this->syncProductImages($create_product, $uploaded_contents);
                return $create_product;

            } else {
                // update
                $update_product = $this->productService->update($product->id, $data);
                $product_images = $this->syncProductImages($product, $uploaded_contents);
                return $product;

            }
        }
    }

    public function setData($row, $category, $brand)
    {
        return [
            'name' => e($row['name']),
            'slug' => Str::slug(e($row['name'])),
            'brand_id' => $brand ? $brand->id : null,
            'details' => htmlspecialchars($row['details']),
            'unit_type' => $row['unit_type'],
            'featured' => $row['featured'] ? 1 : 0,
            'category_id' => $category ? $category->id : null,
            'status' => $row['status'],
            'out_of_stock' => $row['out_of_stock'] == 1 ? 1 : 0,
            'price' => $row['price'],
            'discount_type' => $row['discount_type'],
            'discount_rates' => $row['discount_rates'],
            'sku' => $row['sku'],
            'total_product_units' => $row['total_product_units'],
            'skin_tone' => $row['skin_tone'],
        ];
    }
    public function storeProductImages($images)
    {

        $uploaded_contents = [];
        $images = explode(';', $images);
        if (!empty($images)) {
            foreach ($images as $image) {
                $img = importImageContent($image, 'public/products/');
                $img != false ? $uploaded_contents[] = $img : '';
            }
        }
        return $uploaded_contents;
    }

    public function syncProductImages($product, $uploaded_contents)
    {
        $product_images = [];

        if (!empty($uploaded_contents)) {
            foreach ($uploaded_contents as $upload) {
                $product_images[] = ProductHasImage::create(['image' => $upload, 'product_id' => $product->id]);
            }
        }
        $product->images()->saveMany($product_images);

    }

    public function rules(): array
    {
        return [
            'brand_id' => 'required',
            'category_id' => 'required',
        ];
    }

    public function validationMessages()
    {
        return [
            'brand_id.required' => 'brand must be valid and exist',
            'category_id.required' => 'category must be valid and exist',
        ];
    }
}
