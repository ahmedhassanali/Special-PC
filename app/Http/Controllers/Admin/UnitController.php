<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        try {
            $units =  Unit::get();
            return view('admin.unit.index' , compact('units'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.unit.create');
    }

    public function store(Request $request)
    {
        try {
            Unit::create($request->all());
            return redirect()->route('admin.unit.index')->with('success', 'تم حفظ بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $unit = Unit::find($id);
        return view('admin.unit.update' , compact('unit'));
    }

    public function update(Request $request, $id)
    {
        try {
            $unit = Unit::find($id);
            $unit->update($request->all());
            return redirect()->route('admin.unit.index')->with('success', 'تم تعديل بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $unit = Unit::find($id);
            $unit->delete();
            return redirect()->route('admin.unit.index')->with('success', 'تم حذف');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
