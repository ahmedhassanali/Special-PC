<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Services\ImageService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        try {
            $brands =  Brand::get();
            return view('admin.brand.index' , compact('brands'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        try {
            if (isset($request['photo'])) {
                $image = new ImageService( $request[ 'photo' ], 'storage/brands/');
                $request['image'] =  $image->upload();
            }
            Brand::create($request->all());
            return redirect()->route('admin.brand.index')->with('success', 'تم حفظ بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.update' , compact('brand'));
    }

    public function update(Request $request, $id)
    {
        try {
            $brand = Brand::find($id);
            if (isset($request['photo'])) {
                $request['image'] = ImageService::update($request['photo'] , 'storage/brands/', $brand->image);
            }
            $brand->update($request->all());
            return redirect()->route('admin.brand.index')->with('success', 'تم تعديل بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $brand = Brand::find($id);
            if ($brand->image) {
                $data['image'] = ImageService::delete($brand->image);
            }
            $brand->delete();
            return redirect()->route('admin.brand.index')->with('success', 'تم حذف');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
