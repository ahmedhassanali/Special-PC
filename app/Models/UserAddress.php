<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'type', 'address', 'lat', 'long',];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
