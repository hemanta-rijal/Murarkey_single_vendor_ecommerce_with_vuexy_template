<?php

namespace App\Http\Controllers\Admin\Homepage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Admin\Contracts\FeaturedCategoryRepository;
use Modules\Admin\Requests\CreateFeaturedCategoryRequest;
use Modules\Admin\Requests\UpdateFeaturedCategoryRequest;

class FeaturedCategoriesController extends Controller
{
    protected $categoryRepository;

    public function __construct(FeaturedCategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->getPaginated();

        return view('admin.homepage.featured-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.homepage.featured-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFeaturedCategoryRequest $request)
    {
        $data = $request->all();
        $category = $this->categoryRepository->create($data);

        flash('Featured category added successfully', 'success');

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
        $category = $this->categoryRepository->findById($id);

        return view('admin.homepage.featured-categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeaturedCategoryRequest $request, $id)
    {
        $data = $request->all();

        $this->categoryRepository->update($id, $data);
        
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
        $this->categoryRepository->delete($id);
        flash('Successfully deleted!');

        return $this->redirectTo();
    }

    public function redirectTo()
    {
        return redirect()->route('admin.featured-categories.index');
    }
}
