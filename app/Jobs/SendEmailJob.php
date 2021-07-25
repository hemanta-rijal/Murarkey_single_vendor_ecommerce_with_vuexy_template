<?php

namespace App\Jobs;

use App\Mail\MailToUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    public $timeout = 3600;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = new MailToUser();

        $data['subject'] = $this->details['subject'];
        foreach ($this->details['to'] as $email) {
            $data['email'] = $email;
            $data['name'] = "custom name";
            Mail::send('admin.mail.mail-to-user', [], function ($message) use ($data) {
                $message->to($data['email'], $data['name'])
                    ->subject($data['subject']);
            });
        }

    }
}
