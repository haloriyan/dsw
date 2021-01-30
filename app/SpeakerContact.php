<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpeakerContact extends Model
{
    protected $fillable = ['speaker_id','icon','name','value'];
}
