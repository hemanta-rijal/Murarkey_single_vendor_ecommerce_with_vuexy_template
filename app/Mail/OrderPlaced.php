<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

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
        $user = $this->user;
        $greeting = "<strong>Dear <span>".$this->user->first_name.'</span></strong><br/> <br/>';
        $level = "Your order has been placed successfully. The details of your order is below.";
        $cancelMessage = "Click"."<a href='".URL::to('/user/orders/'.$this->order->id)."'>here</a> to cancel and modify your order";
        $order = $this->order;
        $orderItem = $this->order->items;
        $introLines = ['Thanks for ordering from us.'];
        $outroLines = [];
        $actionUrl = '';

        return $this->view('emails.order.order-email',compact('greeting','level','user','order','cancelMessage','orderItem','introLines','outroLines','actionUrl'));
    }
}
