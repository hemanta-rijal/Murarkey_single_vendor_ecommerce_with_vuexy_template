<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
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
        // dd($product->images);
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
        // dd($product);
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
        $total_products_count = Product::count();
        $searched_products_count = $products->count();
        // print_r($searched_products_count);
        $brands = $this->brandService->getAll();
        return view('frontend.products.search', compact('products', 'brands', 'categories', 'categoryPage', 'searched_products_count', 'total_products_count'));
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

    public function autocompleteSearch(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $products = Product::orderby('name', 'asc')->select('id', 'name', 'price', 'slug')->limit(5)->get();
        } else {
            $products = Product::orderby('name', 'asc')->select('id', 'name', 'price', 'slug')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }
        $response = array();
        if ($products->count() > 0) {
            foreach ($products as $product) {
                $url = URL::to('products/' . $product->slug);
                $image = $product->featured_image ? resize_image_url($product->featured_image, '50X50') : null;
                $response[] = array("id" => $product->id, "name" => $product->name, "value" => $product->name, "label" => "<a href='$url'><img src='$image'> &nbsp; $product->name &nbsp; &nbsp; <strong>Rs. $product->price</strong></a>");
            }
        } else {
            $response[] = array("value" => '', 'label' => 'No Result Found');
        }
        return response()->json($response);
    }

}
