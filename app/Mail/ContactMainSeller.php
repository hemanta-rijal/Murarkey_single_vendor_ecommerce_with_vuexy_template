<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMainSeller extends Mailable
{
    use Queueable, SerializesModels;


    private $user;

    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $data)
    {
        $this->user = $user;

        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $greeting = 'Hello!';


        $introLines[] = 'You have just receive a contact from message with following details';
        $introLines[] = 'Name: ' . $this->data['name'];
        $introLines[] = 'Email: ' . $this->data['email'];

        if (isset($this->data['company']))
            $introLines[] = 'Company: ' . $this->data['company'];
        if (isset($this->data['website']))
            $introLines[] = 'Website: ' . $this->data['website'];

        $introLines[] = 'Subject: ' . $this->data['subject'];
        $introLines[] = 'Message: ' . $this->data['message'];


        return $this->view('emails.contact-main-seller', compact('greeting', 'introLines'));
    }
}
