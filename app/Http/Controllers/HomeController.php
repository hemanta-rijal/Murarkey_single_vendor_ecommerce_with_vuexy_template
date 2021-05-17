<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // $flashSales = get_flash_sales_for_homepage();
        $flashSales = null;
        if($flashSales){
            return view('home', compact('flashSales'));
        }else{
            return view('home');
        }
        
    }
}
