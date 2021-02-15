<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderTicket extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $ticket;
    public $order;

    public function __construct($props)
    {
        $this->user = $props['user'];
	$this->ticket = $props['ticket'];
	$this->order = $props['order'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.OrderTicket')->with([
	    'user' => $this->user,
	    'ticket' => $this->ticket,
	    'order' => $this->order
	]);
    }
}
