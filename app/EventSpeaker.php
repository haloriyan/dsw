<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSpeaker extends Model
{
    protected $table = 'events_speaker';

    public function event() {
        return $this->belongsTo('App\Event', 'events_id');
    }
}
