<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Modules\Admin\Contracts\PageService;
use Modules\Admin\Requests\CreatePageRequest;
use Modules\Admin\Requests\UpdateContactUsRequest;
use Modules\Admin\Requests\UpdatePageRequest;

class PagesController extends Controller
{
    private $pageService;

    public function __construct(PageService $service)
    {
        $this->pageService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->pageService->getPaginated();

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePageRequest $request)
    {
        $data = $request->all();
        $page = $this->pageService->create($data);
        flash('Page added successfully', 'success');

        return $this->redirectTo();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = $this->pageService->findById($id);

        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = $this->pageService->findById($id);

        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, $id)
    {
        $data = $request->all();
        $data['published'] = $data['published'] ?? false;
        $this->pageService->update($id, $data);
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
        $this->pageService->delete($id);
        flash('Successfully deleted!');

        return $this->redirectTo();
    }

    public function contactUsList()
    {
        $data = $this->pageService->getContactUsList();

        return view('admin.contact-us.index', compact('data'));
    }

    public function contactUsShow($id)
    {
        $contact = $this->pageService->getContactUsById($id);

        return view('admin.contact-us.show', compact('contact'));
    }

    public function contactUsUpdateStatus(UpdateContactUsRequest $request, $id)
    {
        $this->pageService->updateContactUsStatus($id, $request->status);

        flash('Successfully updated!');

        return redirect('admin/contact-us');
    }

    public function redirectTo()
    {
        return redirect()->route('admin.pages.index');
    }


    public function deleteContactUsData($id)
    {
        ContactUs::destroy($id);
        flash('ContactUs Data deleted successfully', 'success');

        return back();
    }
}
