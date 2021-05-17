<?php
/**
 
 */

namespace App\Http\Controllers\Operator;


use App\DataTables\NotFoundAWBDataTable;
use App\Http\Controllers\Controller;

class NotFoundAWBController extends Controller
{
    /**
     * Display index page and process dataTable ajax request.
     *
     * @param \App\DataTables\OrdersDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(NotFoundAWBDataTable $dataTable)
    {
        return $dataTable->with(request()->all())->render('operator.not-found-awb');
    }

}