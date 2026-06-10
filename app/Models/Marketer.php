<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'unique_link',
        'total_profit',
        'link_usage_count',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function referralVisits()
    {
        return $this->hasMany(ReferralVisit::class);
    }
}
