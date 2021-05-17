<?php

namespace App\Http\Controllers\Admin\Location;

use App\Models\LocationState;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Location\Requests\CreateStateRequest;
use Modules\Location\Requests\UpdateStateRequest;

class StatesController extends Controller
{
    public function index()
    {
        $states = LocationState::when(request('search'), function ($query) {
            return $query->search(request('search'));
        })
            ->paginate();

        return view('admin.location.states.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.location.states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStateRequest $request)
    {
        $data = $request->all();
        LocationState::create($data);
        flash('Province added successfully', 'success');

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
        $state = LocationState::findOrFail($id);

        return view('admin.location.states.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStateRequest $request, $id)
    {
        $data = $request->only('name', 'country_id');
        LocationState::where('id', $id)->update($data);

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
        return redirect()->route('admin.location.states.index');
    }
}
