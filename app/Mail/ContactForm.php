<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $email;
    public $subject;
    public $message;

    public function __construct($props)
    {
        $this->name = $props['name'];
        $this->email = $props['email'];
        $this->subject = $props['subject'];
        $this->message = $props['message'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.ContactForm')
        ->subject($this->subject . " (DSW Contact Form)")
        ->with([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'bodyMessage' => $this->message,
        ]);
    }
}
