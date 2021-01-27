<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    
    protected $fillable = [
        'rundown_id','type_id','title','description','requirements','prize'
    ];

    public function type() {
        return $this->belongsTo('App\EventType', 'type_id');
    }
    public function timeline() {
        return $this->hasOne('App\Timeline', 'event_id');
    }
    public function rundown() {
        return $this->belongsTo('App\Rundown', 'rundown_id');
    }
    public function tickets() {
        return $this->hasMany('App\Ticket', 'event_id');
    }
}
