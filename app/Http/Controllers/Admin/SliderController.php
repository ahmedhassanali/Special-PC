<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\sliderRequest;
use App\Models\Product;
use App\Models\Slider;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        try {
            $sliders =  Slider::get();
            return view('admin.slider.index' , compact('sliders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        $products = Product::get();
        return view('admin.slider.create' , compact('products'));
    }

    public function store(Request $request)
    {
        try {
            if (isset($request['photo'])) {
                $image = new ImageService( $request[ 'photo' ], 'storage/sliders/');
                $request['image'] =  $image->upload();
            }
            Slider::create($request->all());
            return redirect()->route('admin.slider.index')->with('success', 'تم حفظ  بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        $products = Product::get();
        return view('admin.slider.update' , compact('slider','products'));
    }

    public function update(Request $request, $id)
    {
        try {
            $slider = Slider::find($id);
            if (isset($request['photo'])) {
                $request['image'] = ImageService::update($request['photo'] , 'storage/sliders/', $slider->image);
            }
            $slider->update($request->all());
            return redirect()->route('admin.slider.index')->with('success', 'تم تعديل القسم بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $slider = Slider::find($id);
            if ($slider->image) {
                $data['image'] = ImageService::delete($slider->image);
            }
            $slider->delete();
            return redirect()->route('admin.slider.index')->with('success', 'تم حذف القسم');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
