<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $fillable = [
        'event_id','name','phone','email','linkedin_profile','photo'
    ];

    public function eventspeaker() {
        return $this->hasMany('App\EventSpeaker', 'speaker_id');
    }
    public function contacts() {
        return $this->hasMany('App\SpeakerContact', 'speaker_id');
    }
    public function event() {
        return $this->belongsTo('App\Event', 'event_id');
    }
}
