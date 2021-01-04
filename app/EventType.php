<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $fillable = ['name'];

    public function events() {
        return $this->hasMany('App\Event', 'type_id');
    }
}
