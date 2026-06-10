<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Place;
use App\Models\Product;
use App\Traits\ApiResponser;

class SliderController extends Controller
{
    use ApiResponser;

    public function index()
    {
        try {
            $sliders = Slider::where('status',1)->WithTranslatedFields()->get();

            $sliders = $sliders->map(function ($slider){
                $slider->product = Product::where('id', $slider->product_id)->WithTranslatedFields()->first();
                return $slider;
            });

            return $this->successResponse($sliders, 'All Active sliders');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function show($id)
    {
        try {
            $slider = Slider::WithTranslatedFields()->find($id);

            if(isset($slider->product_id))
                $slider->product = Product::where('id', $slider->product_id)->WithTranslatedFields()->first();

            return $this->successResponse($slider, 'success');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }


}
