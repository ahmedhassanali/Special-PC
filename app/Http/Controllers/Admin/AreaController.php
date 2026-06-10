<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use App\Models\City;
use App\Services\ImageService;
use Illuminate\Http\Request;

class AreaController extends Controller
{

    public function index($id)
    {
        try {
            $city = City::find($id);
            $areas = Area::where('city_id' , $city->id)->get();
            return view('admin.area.index' , compact('city','areas'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create($id)
    {
        $city = City::find($id);
        return view('admin.area.create' ,compact('city'));
    }

    public function store(Request $request)
    {
        try {
            Area::create($request->all());
            return redirect()->route('admin.area.index' , $request->city_id)->with('success', 'تم حفظ بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $area = Area::find($id);
        return view('admin.area.update' , compact('area'));
    }

    public function update(Request $request, $id)
    {
        try {
            $area = Area::find($id);
            $area->update($request->all());
            return redirect()->route('admin.area.index' ,  $area->city_id)->with('success', 'تم تعديل بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $area = Area::find($id);
            $area->delete();
            return redirect()->route('admin.area.index')->with('success', 'تم حذف ');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
