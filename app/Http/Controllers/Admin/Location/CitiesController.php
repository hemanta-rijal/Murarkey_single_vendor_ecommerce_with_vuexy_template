<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Models\LocationCity;
use Modules\Location\Requests\CreateCityRequest;
use Modules\Location\Requests\UpdateCityRequest;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = LocationCity::when(request('search'), function ($query) {
            return $query->search(request('search'));
        })
            ->paginate();

        return view('admin.location.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.location.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCityRequest $request)
    {
        $data = $request->all();
        LocationCity::create($data);
        flash('City added successfully', 'success');

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
        $city = LocationCity::findOrFail($id);

        return view('admin.location.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, $id)
    {
        $data = $request->only('name', 'state_id', 'cod_available');
        LocationCity::where('id', $id)->update($data);

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
        flash('Successfully deleted!');

        return $this->redirectTo();
    }

    public function redirectTo()
    {
        return redirect()->route('admin.location.cities.index');
    }
}
