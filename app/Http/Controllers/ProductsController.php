<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Brand\Contracts\BrandServiceRepo;
use Modules\Categories\Contracts\CategoryService;
use Modules\Location\Contracts\LocationService;
use Modules\Products\Contracts\ProductService;

class ProductsController extends Controller
{
    protected $locationService;
    private $productService;
    private $categoryService;
    private $brandService;

    /**
     * CompaniesController constructor.
     */
    public function __construct(ProductService $productService, CategoryService $categoryService, LocationService $locationService, BrandServiceRepo $brandService)
    {
        $this->brandService = $brandService;
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->locationService = $locationService;
    }

    public function show($slug)
    {

        $product = $this->productService->findBySlugAndApproved($slug);
        $product->load('flash_sale_item');
        $reviewInfo = get_reviews_info($product->id);

        $reviewInfo = $reviewInfo->map(function ($item) {
            $item->rcp = $item->rating * $item->review_count;
            return $item;
        });

        if ($reviewInfo->count() > 0) {
            $avgRating = $reviewInfo->sum('rcp') / $reviewInfo->sum('review_count');
        } else {
            $avgRating = 0;
        }
        dd($product);
        return view('frontend.products.show', compact('product', 'reviewInfo', 'avgRating'));
    }

    public function search(Request $request)
    {
        // dd($request->all());
        // product brand category
        $array = $this->productService->searchBar();
        // dd($array);
        $productsBySlug = $this->productService->productBySlug();
        // dd($productsBySlug);
        if ($array['products']->count() == 0) {
            $array = $productsBySlug;
        }

        $products = $array['products'];
        // dd($products);
        $allProducts = $array['all_products'];

        $products->load('images');

        // $allProducts->load('company');

        $companies = collect([]);

        // $allProducts->map(function ($product) use ($companies) {
        //     $companies->push($product->company);
        // });

        $categories = $this->categoryService->extractCategoriesForSearch($allProducts, true);
        // dd($categories);

        $locations = $this->locationService->extractLocationForSearch($companies);

        if ($request->category) {
            $categoryPage = $this->categoryService->getBySlug($request->category);
        } else {
            $categoryPage = null;
        }
        $brands = $this->brandService->getAll();
        return view('frontend.products.search', compact('products', 'brands', 'categories', 'categoryPage'));
    }

    // public function search(Request $request)
//     {
//         $array = $this->productService->searchBar();
//         $products = $array['products'];
//         $allProducts = $array['all_products'];

//         $products->load('company', 'images');

//         $allProducts->load('company');

//         $companies = collect([]);

//         $allProducts->map(function ($product) use ($companies) {
//                 $companies->push($product->company);
//             });

//         $categories = $this->categoryService->extractCategoriesForSearch($allProducts, true);

//         //  $locations = $this->locationService->extractLocationForSearch($companies);

//         if ($request->category)
//                 $categoryPage = $this->categoryService->getBySlug($request->category);
//             else
//                 $categoryPage = null;

//         return view('products.search', compact('products', 'categories', 'categoryPage'));
//     }

}
