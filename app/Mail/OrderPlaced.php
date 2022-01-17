<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;
    private  $order ,$user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, User $user)
    {
        $this->order = $order;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $greeting = "Hello! ".$this->user->first_name;
        $level = "Success";
        $order = $this->order;
        $orderItem = $this->order->items;
        $introLines = ['Thanks for ordering from us.'];
        $outroLines = [];
        $actionUrl = '';

        return $this->view('emails.order.order-email',compact('greeting','level','order','orderItem','introLines','outroLines','actionUrl'));
    }
}
