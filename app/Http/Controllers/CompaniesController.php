<?php

namespace App\Http\Controllers;

use App\Mail\ContactMainSeller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Categories\Contracts\CategoryService;
use Modules\Companies\Contracts\CompanyService;
use Modules\Companies\Requests\ContactFormRequest;
use Modules\Location\Services\LocationService;

class CompaniesController extends Controller
{
    protected $categoryService;
    protected $locationService;
    private $companyService;

    public function __construct(CompanyService $companyService, LocationService $locationService, CategoryService $categoryService)
    {
        $this->companyService = $companyService;
        $this->categoryService = $categoryService;
        $this->locationService = $locationService;
    }

    public function show($slug)
    {
        $company = $this->companyService->findBySlugAndApproved($slug);


        return view('companies.show.home', compact('company'));
    }


    public function showProducts(Request $request, $slug)
    {
        $company = $this->companyService->findBySlugAndApproved($slug);
        $categories = Category::whereIn('id', $company->approved_products()->pluck('category_id'))->get();
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

        return view('companies.show.products', compact('company', 'products', 'categories'));
    }


    public function showInfo($slug)
    {
        $company = $this->companyService->findBySlugAndApproved($slug);

        return view('companies.show.info', compact('company'));
    }


    public function showContact($slug)
    {
        $company = $this->companyService->findBySlugAndApproved($slug);

        return view('companies.show.contact', compact('company'));
    }


    public function search(Request $request)
    {
        $companies = $this->companyService->searchBar();

        $companies->load('products_obj');
        $products = collect([]);

        foreach ($companies as $company)
            foreach ($company->products_obj as $product)
                $products->push($product);

        $companies->load('featured_products', 'featured_products.images', 'owner.seller');

        $categories = $this->categoryService->extractCategoriesForSearch($products);

        $locations = $this->locationService->extractLocationForSearch($companies);

        return view('companies.search', compact('locations', 'categories', 'companies'));
    }

    public function postContact(ContactFormRequest $request, $slug)
    {
        $company = $this->companyService->findBySlug($slug);

        Mail::to($company->owner->email)->send(new ContactMainSeller($company->owner, $request->all()));

        session()->flash('contact_us_message', 'Success! Email was successfully sent');
        return back();
    }
}
