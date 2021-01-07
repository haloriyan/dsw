<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketOrder extends Model
{
    protected $fillable = [
        'ticket_id','user_id','qty','total_pay','status'
    ];

    public function ticket() {
        return $this->belongsTo('App\Ticket', 'ticket_id');
    }
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
