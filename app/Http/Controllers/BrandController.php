<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function getBrandsByProductSize(){
        $brands = $this->brandService->getBrandWithProductCount();
        return view('frontend.brands.brands')->with('brands',$brands);
    }
}
