<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Marketer;

class HandleReferral
{
    public function handle(Request $request, Closure $next)
    {
        $referralCode = $request->query('ref'); // Get the referral code from the query parameters

        if ($referralCode) {
            $marketer = Marketer::where('unique_link', $referralCode)->first();

            if ($marketer) {
                // Increment the link usage count
                $marketer->increment('link_usage_count');

                // Store the referrer ID in the session
                session()->put('referrer_id', $marketer->id);
            } else {
                // Handle invalid referral code
                return redirect()->route('home')->with('error', 'Invalid referral link.');
            }
        }

        return $next($request);
    }
}
