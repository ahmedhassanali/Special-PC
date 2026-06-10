<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Offer;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SettingController extends Controller
{


    public function index()
    {
        try {
            $setting = Setting::first();
            $offers =  Offer::get();
            $coupons =  Coupon::get();
            return view('admin.setting.update' , compact('setting','offers','coupons'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Setting $setting)
    {
        $offers =  Offer::get();
        $coupons =  Coupon::get();
        return view('admin.setting.update' , compact('setting','coupons','offers'));
    }

    public function update(Request $request)
    {
        try {
            $setting = Setting::first();
            if (!$setting) {

                if (isset($request['photo'])) {
                    $image = new ImageService( $request[ 'photo' ], 'storage/setting/');
                    $request['image'] =  $image->upload();
                }
                Setting::create($request->all());

            } else {
                if (isset($request['photo'])) {
                    $request['image'] = ImageService::update($request['photo'] , 'storage/setting/', $setting->image);
                }
                $setting->update( $request->all());
            }
            return redirect()->route('admin.setting.index')->with('success', 'setting_updated_successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
