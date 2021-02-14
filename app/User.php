<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email','password','employment_status','reason','gender','address','phone','instance',
        'social_linkedin','social_medium','social_tablue',
        'interested_with_dsi','has_joined_dsi','is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function myTeam() {
        return $this->hasOne('App\Team', 'user_chief');
    }
    public function tickets() {
        return $this->hasMany('App\TicketOrder', 'user_id');
    }
}
