<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'name', 'type_id', 'address','bidang_kerja','phone','link','logo'
    ];
}
