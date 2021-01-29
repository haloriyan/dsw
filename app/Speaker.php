<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $fillable = [
        'event_id', 'name','phone','email','linkedin_profile','photo'
    ];

    public function event() {
        return $this->belongsTo('App\Event', 'event_id');
    }
}
