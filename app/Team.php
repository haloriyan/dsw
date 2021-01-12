<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name','user_chief'
    ];
    public function chief() {
        return $this->belongsTo('App\User', 'user_chief');
    }
    public function firstMember() {
        return $this->belongsTo('App\User', 'user_1');
    }
    public function secondMember() {
        return $this->belongsTo('App\User', 'user_2');
    }
}
