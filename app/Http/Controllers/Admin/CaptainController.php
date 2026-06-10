<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Captain;
use App\Models\City;
use App\Models\Order;
use App\Services\ImageService;
use Illuminate\Support\Facades\Hash;

class CaptainController extends Controller
{

    public function index()
    {
        $captains = Captain::get();
        return view('admin.captain.index', compact('captains'));
    }

    public function create()
    {
        $captain = Captain::get();
        $cities  = City::get();
        return view('admin.captain.create', compact('captain' , 'cities'));
    }

    public function store(Request $request)
    {
        try {
            if (isset($request['photo'])) {
                $image = new ImageService($request['photo'], 'storage/captains/');
                $request['image'] =  $image->upload();
            }
            if (isset($request->password)) {
                $request->merge(['password' => Hash::make($request->password)]);
            }
            Captain::create($request->all());
            return redirect()->route('admin.captain.index')->with('success', 'تم حفظ بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $captain = Captain::find($id);
        $cities  = City::get();
        return view('admin.captain.update', compact('captain','cities'));
    }

    public function update(Request $request, $id)
    {
        try {
            $captain = Captain::find($id);
            if (isset($request['photo'])) {
                $request['image'] = ImageService::update($request['photo'], 'storage/captains/', $captain->image);
            }
            if (isset($request->password)) {
                $request->merge(['password' => Hash::make($request->password)]);
            }
            $captain->update($request->all());
            return redirect()->route('admin.captain.index')->with('success', 'تم تعديل بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $captain = Captain::find($id);
            if ($captain->image) {
                $data['image'] = ImageService::delete($captain->image);
            }
            $captain->delete();
            return redirect()->route('admin.captain.index')->with('success', 'تم حذف');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function changeStatus($id)
    {
        try {
            $captain = Captain::find($id);

            if ($captain->status != Captain::ACTIVE)
                $captain->status = Captain::ACTIVE;
            else
                $captain->status = Captain::INACTIVE;

            $captain->save();
            return redirect()->route('admin.captain.index')->with('success', 'تم تغير حالة ');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function orders($id)
    {
        try {
            $orders =  Order::where('captain_id' , $id)->get();
            return view('admin.order.index' , compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
