<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $fillable = [
        'event_id','type','fields'
    ];

    public function event() {
        return $this->belongsTo('App\Event', 'event_id');
    }
}
