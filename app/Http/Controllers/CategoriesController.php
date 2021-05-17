<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Categories\Contracts\CategoryService;

class CategoriesController extends Controller
{
    private $categoryService;

    /**
     * CategoriesController constructor.
     */
    public function __construct(CategoryService $service)
    {
        $this->categoryService = $service;
    }

    public function getChildren(Request $request)
    {
        return $this->categoryService->getChildren($request->category_id);
    }

    public function index()
    {
        $tree = $this->categoryService->getTree();

        return view('categories.index', compact('tree'));
    }
}
