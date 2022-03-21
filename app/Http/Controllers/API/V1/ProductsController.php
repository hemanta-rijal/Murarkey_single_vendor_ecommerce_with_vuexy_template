<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        if ($product) {
            return new ProductResource($product);
        }
        return response()->json(['message' => 'not found', 'success' => false, 'status' => 401]);
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

    public function getSkinTypes(){
        $skin_type = skin_type();
        $data = array();
        for($i=0;$i<count($skin_type); $i++){
            $data[$i] = ['title'=>$skin_type[$i],'slug'=>Str::slug($skin_type[$i])];
        }
        return ['title'=>'Skin TYpe','detail'=>'test 1','data'=>$data];
    }

    public function getSkinConcerns(){
        $skin_concern = skin_concerns();
        $data = array();
        for($i=0;$i<count($skin_concern); $i++){
            $data[$i] = ['title'=>$skin_concern[$i],'slug'=>Str::slug($skin_concern[$i])];
        }
        return ['title'=>'Skin Concerns','detail'=>'test 1','data'=>$data];
    }

    public function getProductType(){
        $product_type = product_types();
        $data= array();
        for($i=0;$i<count($product_type); $i++){
            $data[$i] = ['title'=>$product_type[$i],'slug'=>Str::slug($product_type[$i])];
        }
        return ['title'=>'Product Type','detail'=>'test 1','data'=>$data];
    }

    public function getSkinAndProductNature(){
        $skin_type = $this->getSkinTypes();
        $skin_concerns = $this->getSkinConcerns();
        $product_type = $this->getProductType();
        $data = array_merge(array($skin_type),array($skin_concerns));
        $data = array_merge($data,array($product_type));
        return response()->json(['data'=>$data]);
    }

}
