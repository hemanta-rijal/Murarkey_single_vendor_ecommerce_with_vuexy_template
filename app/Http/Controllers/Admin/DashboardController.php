<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = \DB::select('SELECT sum(order_item.qty * order_item.price) as total FROM order_item INNER JOIN orders ON orders.id = order_item.order_id WHERE orders.status <> \'cancelled\'');

        $totalOrderCount = Order::count();

        return view('admin.dashboard', compact('totalSales', 'totalOrderCount'));
    }
}
