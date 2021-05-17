<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 2/19/19
 * Time: 8:55 PM
 */

namespace App\Http\Controllers\API\V1;


use App\Models\AuctionSales;
use App\Models\Product;
use Dingo\Api\Http\Request;
use DB;

class AuctionSalesController extends BaseController
{
    public function running()
    {
        return Product::onlyApproved()->where('auction', true)->whereNotNull('auction_end_date')->where('auction_end_date', '>', \Carbon\Carbon::now())->with(array_merge(Product::$relationship, ['auction_sales']))->get();
    }

    public function comingSoon()
    {
        return Product::onlyApproved()->where('auction', true)->whereNull('auction_end_date')->with(array_merge(Product::$relationship, ['auction_sales']))->get();
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
        $auctionSale->user_id = $this->auth->user()->id;
        $auctionSale->price = $request->price;

        $auctionSale->save();

        return ['status' => 'ok'];
    }


    public function auctionSales()
    {
        $auctionSales = AuctionSales::where('user_id', $this->auth->user()->id)->latest()->paginate();

        $maxPrices = AuctionSales::select(DB::raw(' product_id, MAX(price) as max_price '))->whereIn('product_id', $auctionSales->map(function ($item) {
            return $item->product_id;
        }))->groupBy('product_id')->get();

        $mappedData = [];
        foreach ($maxPrices as $maxPrice) {
            $mappedData[$maxPrice->product_id] = $maxPrice->max_price;
        }

        foreach ($auctionSales as $sale)
            $sale->maxBidAmount = $mappedData[$sale->product_id];


        $auctionSales->load('product.images');

        return $auctionSales;
    }


    public function changeStatus($auctionSaleId) {
        $auctionSale = AuctionSales::findOrFail($auctionSaleId);
        $auctionSale->cancelled = !$auctionSale->cancelled;

        $auctionSale->save();

        return $auctionSale;
    }
}