<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SubCategory;
use App\Traits\ApiResponser;

class SettingController extends Controller
{
    use ApiResponser;

    public function show()
    {
        try {
            $setting = Setting::WithTranslatedFields()->first();
            return $this->successResponse($setting, 'success');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
