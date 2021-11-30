<?php

namespace App\Imports;

use Throwable;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductHasImage;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Brand\Services\BrandService;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Modules\Products\Contracts\ProductService;
use Modules\Categories\Contracts\CategoryService;

class ProductsImport implements ToModel, WithHeadingRow, SkipsOnError,SkipsEmptyRows, SkipsOnFailure,WithValidation
{
    use Importable,SkipsFailures, SkipsErrors;

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
            $images = explode(';', $row['image']);
            if (!empty($images)) {
                foreach ($images as $image) {
                    $img = importImageContent($image, 'public/products/');
                    $img != false ? $uploaded_contents[] = $img : '';
                }
            }
            if (!empty($uploaded_contents)) {

                $brand = $this->brandService->findBySlug(Str::slug($row['brand_name']));
                $category = $this->categoryService->getBySlug(Str::slug($row['category_name']));
                $product = Product::create([
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'brand_id' => $brand ? $brand->id : null,
                    'details' => htmlspecialchars($row['details']),
                    'unit_type' => $row['unit_type'],
                    'featured' => $row['featured'] ? 1 : 0,
                    'discount_type' => $row['discount_type'],
                    'category_id' => $category ? $category->id : null,
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

    // public function onError(Throwable $e)
    // {
    //     // return $error->getMessage();
    //     // skipping
    //     dd($e);
    // }

//    public function onFailure(Failure $failures) 
//     {
//         dd($failures);
//         // Handle the failures how you'd like.
//     }

    // this function returns all validation errors after import:
    // public function getErrors()
    // {
    //     return $this->errors;
    // }

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
