<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 8/30/18
 * Time: 3:13 PM
 */

namespace App\Http\Controllers\API\V1;


class CategoriesController extends BaseController
{
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
        return get_categories_tree();
    }

}