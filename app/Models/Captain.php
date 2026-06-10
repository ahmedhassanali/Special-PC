<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Laravel\Passport\HasApiTokens;

class Captain extends Authenticatable {

    use HasApiTokens, HasFactory, Notifiable , AuthenticatableTrait;

    const NEWUSER = 1 , OLDUSER = 0 ;
    const ACTIVE = 1 ,INACTIVE = 0 , MALE = 0 , FEMALE = 1;

    protected $fillable = [
        'name','email','password','image','status','phone','gender','age',
        'code','last_seen','email_verified_at','phone_verified_at','rate','city_id','fcm_token','wallet',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orders(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Order::class, 'captain_id');
    }

    public function city() {
        return $this->belongsTo('App\Models\City');
    }

}
