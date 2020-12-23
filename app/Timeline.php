<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $fillable = [
        'event_id','type','open_date','close_date','judgement_date','main_date'
    ];

    public function event() {
        return $this->belongsTo('App\Event', 'event_id');
    }
}
