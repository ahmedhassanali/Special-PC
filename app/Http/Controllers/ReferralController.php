<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marketer;
use Illuminate\Support\Facades\Redirect;

class ReferralController extends Controller
{
    /**
     * Handle the referral link usage.
     *
     * @param  string  $ref
     * @return \Illuminate\Http\Response
     */
    public function handleReferral($ref)
    {
        // Find the marketer by the unique link
        $marketer = Marketer::where('unique_link', $ref)->first();

        if ($marketer) {
            // Optionally, you can add more logic here, like storing referral information
            // For example, you might want to store the referrer ID in the session
            session()->put('referrer_id', $marketer->id);

            // Redirect to a specific page or the home page
            return Redirect::route('home')->with('success', 'Referral link used successfully.');
        } else {
            // Handle invalid referral code
            return Redirect::route('home')->with('error', 'Invalid referral link.');
        }
    }
}
