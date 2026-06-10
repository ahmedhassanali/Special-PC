<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Laravel\Passport\HasApiTokens;

class Customer extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable , AuthenticatableTrait;

    const NEWUSER = 1 , OLDUSER = 0 ;
    const ACTIVE = 1 ,INACTIVE = 0 , MALE = 0 , FEMALE = 1;
    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'name','email','password','image','status','phone','gender','age',
        'code','last_seen','email_verified_at','phone_verified_at','country_id','fcm_token','wallet'
    ];

    /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function user_image() {
        if ( !$this->image ) {
            return 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' .  $this->first_name . '+' . $this->last_name;
        }
        return asset( $this->image );
    }

    public function addresses(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(CustomerAddress::class, 'customer_id');
    }

    public function paymentCards(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(PaymentCard::class, 'customer_id');
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class , 'customer_id');
    }

    public function favourites(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Favorite::class, 'customer_id');
    }


    public function defaultAddress()
    {
        return $this->addresses->where('default' , 1)->first();
    }

}
