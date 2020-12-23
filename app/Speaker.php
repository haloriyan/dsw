<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $fillable = [
        'name','phone','email','linkedin_profile','photo'
    ];

    public function eventspeaker() {
        return $this->hasMany('App\EventSpeaker', 'speaker_id');
    }
}
