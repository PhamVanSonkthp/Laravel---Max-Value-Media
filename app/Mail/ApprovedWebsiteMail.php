<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
// use Illuminate\Contracts\Queue\ShouldQueue; // uncomment to queue

class ApprovedWebsiteMail extends Mailable // implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $website;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $website)
    {
        $this->user = $user;
        $this->website = $website;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Hello from My App')
            ->view('emails.approved_website_mail', ['user' => $this->user,'$website' => $this->website]);
        // ->attach($pathToFile) // attach if needed
    }
}
