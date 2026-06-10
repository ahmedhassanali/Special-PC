<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserLog as ActivityLog;

class UserLog {
    /**
    * Handle an incoming request.
    *
    * @param  \Closure( \Illuminate\Http\Request ): ( \Symfony\Component\HttpFoundation\Response )  $next
    */

    public function handle( Request $request, Closure $next ): Response {
        $activity_log = new ActivityLog();
        $activity_log->user_id = auth()->user()->id;
        $activity_log->role = auth()->user()->user_role->id;
        $activity_log->page = $request->path();
        $activity_log->data = json_encode($request->all());
        $activity_log->save();
        return $next( $request );
    }
}
