<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flashSales = null;
        if ($flashSales) {
            return view('frontend.index', compact('flashSales'));
        } else {
            return view('frontend.index');
        }
    }
}
