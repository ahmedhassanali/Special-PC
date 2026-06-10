<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
 
    public function index()
    {
        $coupons = Coupon::get();
        return view('admin.coupon.index',compact('coupons'));
    }

    public function create()
    {
          return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        Coupon::create($request->all());    
        return redirect()->route('admin.coupon.index')->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(string $id)
    {
          $coupon = Coupon::find( $id );
          return view('admin.coupon.update',compact('coupon'));
    }

    public function update(Request $request, string $id)
    {
          $coupon = Coupon::find( $id );
          $coupon->update( $request->all() );    
          return redirect()->route('admin.coupon.index')->with('success', 'تم التعديل بنجاح');
    }

    public function changeStatus($id){
        try {
            $coupon = Coupon::find($id);

            if ($coupon->status != Coupon::ACTIVE)
                $coupon->status = Coupon::ACTIVE;
            else
                $coupon->status = Coupon::INACTIVE;

            $coupon->save();
            return redirect()->route('admin.coupon.index')->with('success', 'تم تغير حالة ');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $coupon = Coupon::find($id);
            $coupon->delete();
            return redirect()->route('admin.coupon.index')->with('success', 'تم حذف');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
