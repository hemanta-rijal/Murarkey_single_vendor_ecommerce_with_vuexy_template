<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Modules\Categories\Contracts\CategoryService;

class CategoriesController extends BaseController
{
    private $categoryService;

    /**
     * CategoriesController constructor.
     */
    public function __construct(CategoryService $service)
    {
        $this->categoryService = $service;
    }
    /**
     * Categories
     *
     * get all categories
     *
     * @Get("/categories")
     * @Versions({"v1"})
     */

    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
        // return get_categories_tree();
    }
    public function getCategory($id)
    {
        return new CategoryResource($this->categoryService->findById($id));
    }

}
