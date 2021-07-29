<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Requests\CreateBannerRequest;
use Modules\Admin\Requests\UpdateBannerRequest;
use Modules\Admin\Services\BannerService;

class BannersController extends Controller
{
    private $bannerService;

    public function __construct(BannerService $service)
    {
        $this->bannerService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->bannerService->getPaginated();

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBannerRequest $request)
    {
        $data = $request->all();
        $slide = $this->bannerService->create($data, $request->image);

        flash('Banner added successfully', 'success');

        return $this->redirectTo();
    }

    public function redirectTo()
    {
        return redirect()->route('admin.banners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = $this->bannerService->findById($id);

        return view('admin.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = $this->bannerService->findById($id);

        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, $id)
    {
        $data = $request->all();

        $this->bannerService->update($id, $data, $request->image);

        flash('Successfully updated!');

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
        $message = "Can't delete this account";
        if (auth()->id() != $id) {

            $this->bannerService->delete($id);
            $message = 'Successfully deleted!';
        }

        flash($message);
        return $this->redirectTo();
    }
}
