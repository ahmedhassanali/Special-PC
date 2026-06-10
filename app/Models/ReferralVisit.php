<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralVisit extends Model
{
    use HasFactory;

    protected $fillable = ['marketer_id', 'ip_address', 'user_agent', 'visited_at'];

    public function marketer()
    {
        return $this->belongsTo(Marketer::class);
    }
}
