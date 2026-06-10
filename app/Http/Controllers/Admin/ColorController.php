<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        try {
            $colors = Color::get();
            return view('admin.color.index', compact('colors'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.color.create');
    }

    public function store(Request $request)
    {
        try {
            Color::create($request->all());
            return redirect()->route('admin.color.index')->with('success', 'Color saved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $color = Color::find($id);
        return view('admin.color.update', compact('color'));
    }

    public function update(Request $request, $id)
    {
        try {
            $color = Color::find($id);
            $color->update($request->all());
            return redirect()->route('admin.color.index')->with('success', 'Color updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $color = Color::find($id);
            $color->delete();
            return redirect()->route('admin.color.index')->with('success', 'Color deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
