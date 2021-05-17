<?php
/**
 */

namespace App\Http\Controllers\Operator;


use App\Events\OrderShipped;
use App\Http\Controllers\Controller;
use App\Models\NotFoundAwb;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrdersController extends Controller
{
    public function store()
    {
        $item = OrderItem::findOrFail(request('id'));

        $item->fill(request()->except('id'));

        $item->save();

        flash('Order updated successfully', 'success');
        return back();
    }


    public function barcode()
    {
        $message = '';
        if (request('identifier')) {
            try {
                $orderItems = OrderItem::where('seller_awb_no', request('identifier'))->get();

                if ($orderItems->count() > 0) {
                    foreach ($orderItems as $orderItem) {

                        if ($orderItem->status != OrderItem::ORDER_SHIPPED) {
                            event(new OrderShipped($orderItem));
                            $orderItem->scan_at = Carbon::now();
                        }

                        $orderItem->status = OrderItem::ORDER_SHIPPED;
                        $orderItem->save();
                    }
                    $message = 'Successfully order item updated';
                } else {
                    throw new ModelNotFoundException();
                }

            } catch (ModelNotFoundException $exception) {
                $notFoundAwb = new NotFoundAwb();
                $notFoundAwb->awb = request('identifier');
                $notFoundAwb->save();

                $message = 'AWB added in not found list';
            }
        }


        return view('operator.barcode', compact('message'));
    }

}