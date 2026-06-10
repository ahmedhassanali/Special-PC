<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Marketer;

class TrackLinkUsage
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('ref')) {
            $marketer = Marketer::where('unique_link', $request->input('ref'))->first();
            if ($marketer) {
            //    $marketer->increment('link_usage_count');
            }
        }

        return $next($request);
    }
}
