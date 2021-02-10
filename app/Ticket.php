<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'event_id','name','description','price'
    ];

    public function event() {
        return $this->belongsTo('App\Event', 'event_id');
    }
    public function orders() {
        return $this->hasMany('App\TicketOrder', 'ticket_id');
    }
}
