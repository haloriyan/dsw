<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    protected $fillable = [
        'event_id','name','phone','email','linkedin_profile','photo'
    ];

    public function contacts() {
        return $this->hasMany('App\JudgesContact', 'judges_id');
    }
    public function event() {
        return $this->belongsTo('App\Event', 'event_id');
    }
    public function contacts() {
        return $this->hasMany('App\JudgeContact', 'judge_id');
    }
}
