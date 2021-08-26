<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPasswordReset extends Mailable
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
        $introLines = ['Thanks for connecting with us. In order to verify your email address, please click below link'];
        $outroLines = [];
        $actionText = 'Verify And Proceed To Reset';
        $actionUrl = route('auth.verify-and-reset', $this->user->email_verification_token);

        return $this->view('emails.email-verification', compact('level', 'actionText', 'actionUrl', 'outroLines', 'introLines'));
    }
}
