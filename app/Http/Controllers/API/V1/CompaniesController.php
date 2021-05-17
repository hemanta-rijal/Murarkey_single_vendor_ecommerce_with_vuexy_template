<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 9/3/18
 * Time: 4:06 PM
 */

namespace App\Http\Controllers\API\V1;


use Dingo\Api\Http\Request;
use Modules\Companies\Contracts\CompanyService;

class CompaniesController extends BaseController
{
    private $companyService;

    /**
     * CompaniesController constructor.
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Approved companies
     *
     * get all Approved Companies
     *
     * @Get("/companies")
     * @Versions({"v1"})
     */

    public function index()
    {
        $type = 'approved';

        $companies = $this->companyService->getPaginated($type);

        return $companies;
    }


    /**
     * Get company
     *
     * get a company by id
     *
     * @Get("/companies")
     * @Versions({"v1"})
     */

    public function show($id)
    {
        $company = $this->companyService->findById($id);

        $company->load('images', 'country', 'province_obj', 'city_obj');

        return $company;
    }


    /**
     * Get products
     *
     * Get products by company id
     * @Parameters({
     *      @Parameter("page", description="For getting specific page data", default=1),
     *      @Parameter("search", description="for searching products"),
     *      @Parameter("category", description="for filtering category id wise")
     * })
     * @Get("/companies/{id}/products")
     * @Versions({"v1"})
     */

    public function products(Request $request, $companyId)
    {
        $company = $this->companyService->findById($companyId);
        $products = $company->approved_products()
            ->when($request->search, function ($query) use ($request) {
                return $query->search($request->search);
            })
            ->when($request->category, function ($query) use ($request) {
                return $query->whereHas('category', function ($q) use ($request) {
                    return $q->where('slug', $request->category);
                });
            })
            ->groupBy('products.id')
            ->paginate($request->per_page ? $request->per_page : 20);

        $products->load('category', 'images', 'trade_infos');

        return $products;
    }
}