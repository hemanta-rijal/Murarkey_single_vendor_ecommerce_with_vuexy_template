<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Modules\Brand\Services\BrandService;
use Modules\Products\Services\ProductService;

class BrandController extends Controller
{
    private $brandService;
    private $productService;
    public function __construct(BrandService $brandService,ProductService $productService)
    {
        $this->brandService = $brandService;
        $this->productService = $productService;
    }
    public function getBrandsByProductSize(Request $request){
        $name = $request->has('name')? $request->get('name'):null;
        $brands = $this->brandService->getBrandWithProductCount($name);
        $options = [
            "path" => URL::to('brands'),
            "pageName" => "page"
        ];
        return view('frontend.brands.brands')->with('brands', $this->paginate($brands,$perPage = 15, $page = null, $options));
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
