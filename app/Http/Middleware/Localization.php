<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the request contains a language parameter
        $locale = $request->get('lang');

        // If no language parameter, use the one stored in the session
        if (!$locale && session()->has('lang')) {
            $locale = session()->get('lang');
        }

        // If still no locale, use the default language
        if (!in_array($locale, ['en', 'ar'])) {
            $locale = 'ar'; // Set default language
        }

        // Set the application locale
        App::setLocale($locale);

        // Store the selected language in the session
        session()->put('lang', $locale);

        return $next($request);
    }
}
