<?php

namespace App\Http\Controllers\Admin\Homepage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Admin\Contracts\FeaturedCompanyRepository;
use Modules\Admin\Requests\CreateFeaturedCompanyRequest;
use Modules\Admin\Requests\UpdateFeaturedCompanyRequest;

class FeaturedCompaniesController extends Controller
{
    protected $companyRepository;

    public function __construct(FeaturedCompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->companyRepository->getPaginated();

        return view('admin.homepage.featured-companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.homepage.featured-companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFeaturedCompanyRequest $request)
    {
        $data = $request->all();
        $company = $this->companyRepository->create($data);

        flash('Featured Company  added successfully', 'success');

        return $this->redirectTo();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = $this->companyRepository->findById($id);

        return view('admin.homepage.featured-companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeaturedCompanyRequest $request, $id)
    {
        $data = $request->all();

        $this->companyRepository->update($id, $data);

        flash('Successfully Updated!');

        return $this->redirectTo();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->companyRepository->delete($id);
        flash('Successfully deleted!');

        return $this->redirectTo();
    }

    public function redirectTo()
    {
        return redirect()->route('admin.featured-companies.index');
    }
}
