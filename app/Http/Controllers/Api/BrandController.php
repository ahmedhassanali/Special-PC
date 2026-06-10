<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Traits\ApiResponser;

class BrandController extends Controller
{
    use ApiResponser;

    public function index()
    {
        try {
            $brands = Brand::WithTranslatedFields()->get();
            return $this->successResponse($brands, 'All brands');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function show($id)
    {
        try {
            $brand = Brand::WithTranslatedFields()->find($id);
            $products = Product::where('brand_id', $brand->id)->WithTranslatedFields()->get();
            return $this->successResponse($products, 'success');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
