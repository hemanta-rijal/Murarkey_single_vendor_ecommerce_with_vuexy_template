<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 2/9/19
 * Time: 3:40 PM
 */

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\AuctionSales;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;

class AuctionController extends Controller
{

    public function index()
    {
        $auctionSales = DB::select("
        SELECT
        a.id
        FROM auction_sales AS a
        JOIN (SELECT
          product_id,
          MAX(price) AS max_price
        FROM auction_sales aa WHERE aa.cancelled = 0
        GROUP BY product_id) aaa ON a.product_id = aaa.product_id AND aaa.max_price = a.price AND a.cancelled = 0");


        $ids = array_map(function ($item) {
            return $item->id;
        }, $auctionSales);

        $auctionSales = AuctionSales::whereIn('id', $ids)->paginate();

        $auctionSales->load('product', 'user');


        return view('user.auction-sales', compact('auctionSales'));
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $this->validate($request, [
            'product_id' => 'required',
            'price' => 'required|numeric|min:' . ($product->max_auction_price + 1)
        ]);

        $auctionSale = new AuctionSales();
        $auctionSale->product_id = $request->product_id;
        $auctionSale->user_id = auth()->user()->id;
        $auctionSale->price = $request->price;

        $auctionSale->save();

        return back();
    }


    public function bids($productId) {
        $items = AuctionSales::where('product_id', $productId)->orderBy('price', 'DESC')->get();

        $items->load('user');

        return view('user.partial-auction-sales', compact('items'));
    }


    public function changeStatus($auctionSaleId) {
        $auctionSale = AuctionSales::findOrFail($auctionSaleId);
        $auctionSale->cancelled = !$auctionSale->cancelled;

        $auctionSale->save();

        return back();
    }

    public function sendNotification($auctionSaleId) {

        $auctionSale = AuctionSales::findOrFail($auctionSaleId);

        sendSms($auctionSale->user->phone_number, sprintf('congratulation, %s you won the auction. Your product is being ready for delivery. KABMART', $auctionSale->user->name));

        return back();
    }
}