<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CancelOrderItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancel:order-item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It\'s cancels order item.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sixDaysAgo = Carbon::parse('6 days ago');
        $cancellationActive = Carbon::parse('2019-04-27');
        $orderItems = OrderItem::whereIn('status', OrderItem::NON_RECONCILE)->where('created_at', '>', $cancellationActive)->where('created_at', '<', $sixDaysAgo)->get();

        $orderItems->load('product.category.parent');

        $groupData = $orderItems->groupBy('order_id');



        foreach ($groupData as $orderId => $items) {
            foreach ($items as $item) {
//                $item->remarks = 'Order cancelled automatically';
                $item->status = OrderItem::ORDER_CANCEL;
//                $item->save();
//
//                if ($item->product->category->parent)
//                    $cc = [$item->product->category->parent->name, $item->product->category->name];
//                else
//                    $cc = [$item->product->category->name];
//
//
//                for ($i = 0; $i < count($cc); $i++) {
//                    $cc[$i] = str_replace(' and ', '/', strtolower($cc[$i]));
//                }


//                $itemText = (empty($itemText) ? ', ' : '') . implode('-', $cc);
            }
            $order = Order::findOrFail($orderId);
            $mobileNumber = $order->shipment_detail['phone_number'];
            $oo = $items->count() === 1 ? 'item' : 'items';

            $smsText = "{$items->count()} {$oo} of Order #{$order->id} has been cancelled. KABMART";

            print_r($smsText);
            echo PHP_EOL;
//            sendSms($mobileNumber, $smsText);
        }


    }
}
