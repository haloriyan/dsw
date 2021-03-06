<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $fillable = [
        'name','description'
    ];

    public function tickets() {
        return $this->hasMany('App\Ticket', 'type_id');
    }
}
