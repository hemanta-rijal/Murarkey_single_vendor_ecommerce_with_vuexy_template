<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductHasImage;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = \DB::select('SELECT sum(order_item.qty * order_item.price) as total FROM order_item INNER JOIN orders ON orders.id = order_item.order_id WHERE orders.status <> \'cancelled\'');

        $totalOrderCount = Order::count();
        return view('admin.dashboard', compact('totalSales', 'totalOrderCount'));
    }

    //import export
    public function ImportExport()
    {
        return view('admin.reports.import-export');
    }
    public function Export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');

    }
    public function getImageFromDirectory(){
        //fetch image from directory
        $dir = base_path('storage\app\public\products');
        $files =  scandir($dir);
        // fetch image from database
        $image = ProductHasImage::all();
        $img = [];
        foreach ($image as $key=>$value){
            $img[$key] =str_replace('public/products/','',$value->image);
        }

        $result = array_diff($files,$img);
        foreach ($result as $value) {
            if($value!="." && $value!=".."){
                unlink($dir.'/'.$value);
           }
        }
        return "success";
    }
}
