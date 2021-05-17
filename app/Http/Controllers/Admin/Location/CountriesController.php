<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Models\LocationCountry;
use Modules\Location\Requests\CreateCountryRequest;
use Modules\Location\Requests\UpdateCountryRequest;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = LocationCountry::when(request('search'), function ($query) {
            return $query->search(request('search'));
        })
            ->paginate();

        return view('admin.location.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.location.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCountryRequest $request)
    {
        $data = $request->all();
        LocationCountry::create($data);
        flash('Country added successfully', 'success');

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
        $country = LocationCountry::findOrFail($id);

        return view('admin.location.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, $id)
    {
        $data = $request->only('name', 'sortname', 'phonecode');
        
        LocationCountry::where('id', $id)->update($data);

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
        return redirect()->route('admin.location.countries.index');
    }
}
