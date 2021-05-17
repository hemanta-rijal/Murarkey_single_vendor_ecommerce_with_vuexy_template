<?php

namespace App\Console\Commands;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ConfirmOrderItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'confirmed:order-item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It\'s confirms order item.';

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
        $eightHourAgo = Carbon::parse('8 hour ago');
        $activeDate = Carbon::parse('2019-04-27');
        $orderItems = OrderItem::where('status', OrderItem::ORDER_INITIAL)->where('created_at', '>', $activeDate)->where('created_at', '<', $eightHourAgo)->get();

        $groupData = $orderItems->groupBy('order_id');

        foreach ($groupData as $orderId => $items) {
            foreach ($items as $item) {
                $item->status = OrderItem::ORDER_CONFIRMED;
                $item->save();
            }
        }
    }
}
