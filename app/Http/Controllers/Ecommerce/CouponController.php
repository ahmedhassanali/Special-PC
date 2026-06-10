<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function check(Request $request)
    {
        try {
            $coupon = Coupon::where('code', $request->coupon_input)->first();
            if ($coupon && $coupon->status === Coupon::ACTIVE) {
                $currentTime = now();
                if ($currentTime->lte($coupon->end_at)) {
                    if ($coupon->uses < $coupon->max) {
                        return redirect()->back()->with(compact('coupon'));
                    } else {
                        return redirect()->back()->with('error', 'Coupon has reached maximum uses');
                    }
                } else {
                    return redirect()->back()->with('error', 'Coupon has expired');
                }
            } else {
                return redirect()->back()->with('error', 'Coupon is not valid or inactive');
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }
}
