<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rundown extends Model
{
    protected $fillable = [
        'title','date','start_time','end_time','notes'
    ];

    public function events() {
        return $this->hasMany('App\Event', 'rundown_id');
    }
}
