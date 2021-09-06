<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Modules\Currency\Contracts\CurrencyServiceRepository;

class CurrencyController extends Controller
{

    private $currencyService;

    public function __construct(CurrencyServiceRepository $service)
    {
        $this->currencyService = $service;
    }

    private function RedirectTo()
    {
        return redirect()->route('admin.currencies.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = $this->currencyService->getPaginated();
        return view('admin.currency.index')->with(compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currency.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            if ($request->hasFile('icon')) {
                $data['icon'] = $request->icon->store('public/currency');
            }

            $this->currencyService->create($data);
            flash('successfully added !!!')->success();
        } catch (\Throwable $th) {
            flash('could not add the details !!!')->error();
            flash($th->getMessage())->error();
            return redirect()->back();
        }
        return $this->RedirectTo();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = $this->currencyService->findById($id);
        return view('admin.currency.edit')->with('currency', $currency);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->icon->store('public/currency');
        }
        $this->currencyService->update($id, $data);
        flash('Successfully Updated!');
        return $this->redirectTo();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        //
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        try {
            \DB::table("currencies")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted');
            return response()->json(['success' => "Currency Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted');
            return response()->json(['error' => "Currency Could Not Be  Deleted."]);
        }
    }
}
