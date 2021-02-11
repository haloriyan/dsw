<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $encodedEmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($props)
    {
        $this->user = $props['user'];
        $this->encodedEmail = $props['encodedEmail'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Atur Ulang Kata Sandi untuk Akun Data Science Weekend")
        ->view('email.ResetPassword')->with([
            'user' => $this->user,
            'encodedEmail' => $this->encodedEmail,
        ]);
    }
}
