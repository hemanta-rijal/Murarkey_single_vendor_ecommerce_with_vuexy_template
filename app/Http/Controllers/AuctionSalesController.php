<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AuctionSalesController extends Controller
{
    public function running()
    {
        $auctionSales = Product::onlyApproved()
            ->where('auction', true)
            ->whereNotNull('auction_end_date')
            ->where('auction_end_date', '>', \Carbon\Carbon::now())
            ->with(Product::$relationship)
            ->get();

        return view('auction-sales.running', compact('auctionSales'));
    }

    public function comingSoon()
    {
        $auctionSales = Product::onlyApproved()
            ->where('auction', true)
            ->whereNull('auction_end_date')
            ->where('auction_end_date', '>', \Carbon\Carbon::now())
            ->with(Product::$relationship)
            ->get();

        return view('auction-sales.comingsoon', compact('auctionSales'));
    }
}
