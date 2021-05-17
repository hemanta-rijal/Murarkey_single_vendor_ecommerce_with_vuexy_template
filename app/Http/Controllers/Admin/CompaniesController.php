<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Companies\Contracts\CompanyService;
use Modules\Companies\Requests\UpdateCompanyRequestByAdmin;

class CompaniesController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = request()->type;

        $companies = $this->companyService->getPaginated($type);
        $counts = $this->companyService->getCountOfCompanies();

        $companies->appends(['type' => $type]);

        return view('admin.companies.index', compact('companies', 'counts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = $this->companyService->findById($id);
        $products = $company->products_obj()->paginate();

        $products->load(['trade_infos', 'images', 'category']);


        return view('admin.companies.show', compact('company', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = $this->companyService->findById($id);

        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequestByAdmin $request, $id)
    {
        $companyFiles = $request->file('company') ?? [];
        $images = $request->file('images') ?? [];
        $data = $request->all();

        $this->companyService->updateByAdmin($id, $data, $companyFiles, $images);

        return $this->redirectTo();

    }

    public function updateStatus($id, $status)
    {
        $this->companyService->updateStatus($id, $status);
        flash('Successfully Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $company = $this->companyService->delete($id, $request->force);

        flash('Successfully Deleted!');


        return $this->redirectTo();
    }

    public function recover(Request $request, $id)
    {
        $company = $this->companyService->recover($id);

        if ($company)
            flash('Successfully Recover!');
        else
            flash('Can\'t recover company because company owner have already engage in other company', 'danger');

        return back();
    }

    public function trash(Request $request)
    {
        $companies = $this->companyService->getTrashItems();

        return view('admin.companies.trash', compact('companies'));
    }

    public function redirectTo()
    {
        return redirect()->route('admin.companies.index');
    }
}
