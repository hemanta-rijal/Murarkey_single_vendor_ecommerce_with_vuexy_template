<?php

namespace App\Http\Controllers;


class FlashSalesController extends Controller
{

    public function index() {
        return view('flash-sales.index', ['flashSales' => get_flash_sales_for_homepage()]);
    }

}