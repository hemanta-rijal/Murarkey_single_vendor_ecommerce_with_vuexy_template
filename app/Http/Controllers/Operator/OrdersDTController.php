<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 3/26/19
 * Time: 9:50 AM
 */

namespace App\Http\Controllers\Operator;


use App\DataTables\OrdersDataTable;
use App\Http\Controllers\Controller;

class OrdersDTController extends Controller
{
    /**
     * Display index page and process dataTable ajax request.
     *
     * @param \App\DataTables\OrdersDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->with(request()->all())->render('operator.orders');
    }

}