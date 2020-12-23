<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = [
        'type_id','title','description','requirements','prize'
    ];

    public function type() {
        return $this->belongsTo('App\EventType', 'type_id');
    }
}
