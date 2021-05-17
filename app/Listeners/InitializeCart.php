<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/22/18
 * Time: 11:14 AM
 */

namespace App\Listeners;


use Cart;
use Illuminate\Auth\Events\Login;

class InitializeCart
{

    public function handle(Login $event)
    {
        Cart::restore($event->user->id);
    }

}