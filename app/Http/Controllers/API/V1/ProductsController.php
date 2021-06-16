<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\product\ProductResource;
use Illuminate\Http\Request;
use Modules\Categories\Contracts\CategoryService;
use Modules\Location\Contracts\LocationService;
use Modules\Products\Contracts\ProductService;

class ProductsController extends BaseController
{
    protected $locationService;
    private $productService;
    private $categoryService;

    /**
     * CompaniesController constructor.
     */
    public function __construct(ProductService $productService, CategoryService $categoryService, LocationService $locationService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->locationService = $locationService;
    }

    /**
     * Get products
     *
     * @Parameters({
     *      @Parameter("category", description="Category slug"),
     *      @Parameter("lower_price", description="price lower price"),
     *      @Parameter("upper_price", description="price upper price"),
     *      @Parameter("search", description="price upper price"),
     *      @Parameter("order_by", description="lowest_price or highest_price")
     * })
     * @Get("/products")
     * @Versions({"v1"})
     */
    public function index(Request $request)
    {
        $array = $this->productService->searchBar();
        $products = $array['products'];
        $allProducts = $array['all_products'];

        $products->load('company', 'images', 'trade_infos');

        $allProducts->load(['company' => function ($query) {
            return $query->select('id', 'city');
        }]);

        $companies = collect([]);

        $allProducts->map(function ($product) use ($companies) {
            $companies->push($product->company);
        });

        // $categories = $this->categoryService->extractCategoriesForSearch($allProducts, true);

        // $locations = $this->locationService->extractLocationForSearch($companies);

        // return compact('products', 'categories');
        // dd($allProducts);
        return ProductResource::collection($allProducts);
    }

    public function show($id)
    {
        $product = $this->productService->findByIdAndApproved($id);
        $product->loadBasicRelationship();
        // return $product;
        return new ProductResource($product);
    }

    public function search(Request $request)
    {
        $array = $this->productService->searchBar();
        $productsBySlug = $this->productService->productBySlug();
        if ($array['products']->count() == 0) {
            $array = $productsBySlug;
        }
        $products = $array['products'];
        $products->load('images');
        return ProductResource::collection($products);
    }

}
