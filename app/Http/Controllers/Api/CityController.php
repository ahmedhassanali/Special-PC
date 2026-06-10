<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Traits\ApiResponser;

class CityController  extends Controller
{
    use ApiResponser;


    public function index()
    {
        try {
            $cities = City::WithTranslatedFields()->get();
            return $this->successResponse($cities, 'All cities');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function show($id)
    {
        try {
            $city = City::WithTranslatedFields()->find($id);
            $city->area =  Area::where('city_id', $city->id)->WithTranslatedFields()->get();
            return $this->successResponse($city->area, 'success');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
