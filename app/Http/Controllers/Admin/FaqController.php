<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Faq\Contracts\FaqServiceRepository;
use Modules\Faq\Requests\FaqCreateRequest;

class FaqController extends Controller
{
    protected $faqServices;
    public function __construct(FaqServiceRepository $faqServices)
    {
        $this->faqServices = $faqServices;
    }

    public function index()
    {
        $faqs = $this->faqServices->getAll();
        return view('admin.faq.index')->with('faqs', $faqs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqCreateRequest $request)
    {
        $data = $request->only('question', 'answer');
        $this->faqServices->create($data);
        return redirect()->route('admin.faq.index')->with('success', 'Faq Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = $this->faqServices->findById($id);
        return view('admin.faq.edit')->with('faq', $faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqCreateRequest $request, $id)
    {
        $data = $request->only('question', 'answer');
        if ($this->faqServices->update($id, $data)) {
            return redirect()->route('admin.faq.index')->with('success', 'Faq update Successfully');
        }
        return redirect()->back()->with('danger', 'Faq could not update ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {

            if ($this->faqServices->delete($id)) {
                flash('FAQ has been deleted.')->success();
                return response()->json(['status' => true]);
            }
            flash('FAQ can not be deleted.')->error();
            return response()->json(['status' => false]);
        }
    }
}
