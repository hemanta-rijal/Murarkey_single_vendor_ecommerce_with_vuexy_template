<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 3/12/19
 * Time: 11:24 AM
 */

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\AuctionSales;
use DB;

class MyAuctionController extends Controller
{

    public function index()
    {
        $auctionSales = AuctionSales::where('user_id', auth()->user()->id)->latest()->paginate();

        $maxPrices = AuctionSales::select(DB::raw(' product_id, MAX(price) as max_price '))->whereIn('product_id', $auctionSales->map(function ($item) {
            return $item->product_id;
        }))->groupBy('product_id')->get();

        $mappedData = [];
        foreach ($maxPrices as $maxPrice) {
            $mappedData[$maxPrice->product_id] = $maxPrice->max_price;
        }

        $auctionSales->load('product');
        return view('user.my-auction-sales', compact('auctionSales', 'mappedData'));
    }

    public function store($auctionSaleId)
    {
        $auctionSale = AuctionSales::where('id', $auctionSaleId)->where('user_id', auth()->user()->id)->first();

        if ($auctionSale) {
            $auctionSale->cancelled = !$auctionSale->cancelled;
            $auctionSale->save();
        }

        return back();
    }

}