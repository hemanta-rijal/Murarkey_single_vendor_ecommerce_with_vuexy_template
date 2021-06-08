<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserEmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $level = 'success';
        $introLines = ['Thanks for sign up. In order to verify email address, please click below link'];
        $outroLines = [];
        $actionText = 'Verify';
        $actionUrl = route('auth.verify', md5($this->user->email));

        return $this->view('emails.email-verification', compact('level', 'actionText', 'actionUrl', 'outroLines', 'introLines'));
    }
}
