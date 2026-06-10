<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Product;
use App\Services\ImageService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    use ApiResponser;
    public function check(Request $request)
    {
        try {
            $code = $request->input('code');
            $coupon = Coupon::where('code', $code)->first();
            if ($coupon && $coupon->status === Coupon::ACTIVE) {
                $currentTime = now();
                if ($currentTime->lte($coupon->end_at)) {
                    if ($coupon->uses < $coupon->max) {
                        return $this->successResponse($coupon, 'Valid');
                    } else {
                        return $this->errorResponse('Coupon has reached maximum uses', 404);
                    }
                } else {
                    return $this->errorResponse('Coupon has expired', 404);
                }
            } else {
                return $this->errorResponse('Coupon is not valid or inactive', 404);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
