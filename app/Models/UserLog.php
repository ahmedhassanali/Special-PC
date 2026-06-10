<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model {
    use HasFactory;

    public function ConvertAr( $value ) {
        return $value ? \Carbon\Carbon::parse( $value )->locale( 'ar' )->isoFormat( 'dddd, D MMMM YYYY HH:mm A' ) : null;
    }

    public function user() {
        return $this->belongsTo( 'App\Models\User' );
    }

    public function role() {
        return $this->belongsTo( 'App\Models\UserRole', 'role' );
    }
}
