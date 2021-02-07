<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckoutTicket extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $ticket;
    public $event;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datas)
    {
        $this->ticket = $datas['ticket'];
        $this->event = $datas['event'];
        $this->order = $datas['order'];
        $this->status = $datas['status'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.CompleteOrder')->with([
            'ticket' => $this->ticket,
            'event' => $this->event,
            'order' => $this->order,
            'status' => $this->status,
        ]);
    }
}
