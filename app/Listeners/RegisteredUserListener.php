<?php

namespace App\Listeners;

use App\Mail\UserEmailVerification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class RegisteredUserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
//        if(!$event->user->verified) {
//            Mail::to($event->user->email)->send(new UserEmailVerification($event->user));
//            sendOtpForRegistration($event->user);
//        }
    }

    public function sendMail()
    {

    }
}
