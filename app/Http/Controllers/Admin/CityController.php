<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        try {
            $cities =  City::with('area')->get();
            return view('admin.city.index' , compact('cities'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.city.create');
    }

    public function store(Request $request)
    {
        try {
            City::create($request->all());
            return redirect()->route('admin.city.index')->with('success', 'تم حفظ بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $city = City::find($id);
        return view('admin.city.update' , compact('city'));
    }

    public function update(Request $request, $id)
    {
        try {
            $city = City::find($id);
            $city->update($request->all());
            return redirect()->route('admin.city.index')->with('success', 'تم تعديل بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $city = City::find($id);
            $city->delete();
            return redirect()->route('admin.city.index')->with('success', 'تم حذف ');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
