<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Models\LocationAreaCode;
use Modules\Location\Requests\CreateAreaCodeRequest;
use Modules\Location\Requests\UpdateAreaCodeRequest;

class AreaCodeController extends Controller
{
    public function index()
    {
        $areaCodes = LocationAreaCode::when(request('search'), function ($query) {
            return $query->search(request('search'));
        })
            ->paginate();

        return view('admin.location.area-code.index', compact('areaCodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.location.area-code.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAreaCodeRequest $request)
    {
        $data = $request->all();
        LocationAreaCode::create($data);
        flash('Area Code added successfully', 'success');

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
        $areaCode = LocationAreaCode::findOrFail($id);

        return view('admin.location.area-code.edit', compact('areaCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAreaCodeRequest $request, $id)
    {
        $data = $request->only('area_code');
        LocationAreaCode::where('id', $id)->update($data);

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
        LocationAreaCode::destroy($id);
        flash('Successfully deleted!');

        return $this->redirectTo();
    }

    public function redirectTo()
    {
        return redirect()->route('admin.location.area-code.index');
    }
}
