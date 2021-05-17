<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Admin\Contracts\MetaService;
use Modules\Admin\Requests\CreateMetaRequest;
use Modules\Admin\Requests\UpdateMetaRequest;

class MetasController extends Controller
{

    private $metaService;

    public function __construct(MetaService $service)
    {
        $this->metaService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metas = $this->metaService->getPaginated();

        return view('admin.metas.index', compact('metas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.metas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMetaRequest $request)
    {
        $data = $request->all();
        $meta = $this->metaService->create($data);
        flash('Meta added successfully', 'success');
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
        $meta = $this->metaService->findById($id);

        return view('admin.metas.show', compact('meta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meta = $this->metaService->findById($id);

        return view('admin.metas.edit', compact('meta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMetaRequest $request, $id)
    {
        $data = $request->all();
        $this->metaService->update($id, $data);
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
        $this->metaService->delete($id);
        flash('Successfully deleted!');

        return $this->redirectTo();
    }

    public function redirectTo()
    {
        return redirect()->route('admin.metas.index');
    }
}
