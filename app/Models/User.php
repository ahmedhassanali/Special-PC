<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    const ACTIVE = 1 ;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'status',
        'role',
        'phone',
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

    // user log

    public function user_log() {
        return $this->hasMany( UserLog::class );
    }

    public function user_role() {
        return $this->belongsTo( 'App\Models\UserRole', 'role' );
    }

    // user image if not uploaded default image will be used

    public function user_image() {
        if ( !$this->image ) {
            return 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' .  $this->first_name . '+' . $this->last_name;
        }
        return asset( $this->image );
    }

    public function addresses(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }
}
