<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'type_id','name','description','price'
    ];

    public function type() {
        return $this->belongsTo('App\TicketType', 'type_id');
    }
}
