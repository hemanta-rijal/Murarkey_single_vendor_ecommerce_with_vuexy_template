<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\FeaturedCategoryResource;
use Modules\Admin\Contracts\FeaturedCategoryRepository;
use Modules\Categories\Contracts\CategoryService;

class CategoriesController extends BaseController
{
    private $categoryService;
    protected $categoryRepository;

    /**
     * CategoriesController constructor.
     */
    public function __construct(CategoryService $service, FeaturedCategoryRepository $categoryRepository)
    {
        $this->categoryService = $service;
        $this->categoryRepository = $categoryRepository;

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
        return response()->json(['data' => get_categories_tree()]);
        // $categories = Category::all();
        // return CategoryResource::collection($categories);
    }
    public function getCategory($id)
    {
        return new CategoryResource($this->categoryService->findById($id));
    }
    public function getFeaturedCategories()
    {
        $categories = $this->categoryRepository->getForHomePage();
        // return $categories;
        return FeaturedCategoryResource::collection($categories);
    }

}
