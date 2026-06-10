<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Traits\ApiResponser;

class SubCategoryController extends Controller
{
    use ApiResponser;


    public function index()
    {
        try {
            $subcategories = SubCategory::WithTranslatedFields()->get();
            return $this->successResponse($subcategories, 'All SubCategories');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function show($id)
    {
        try {
            $subcategory = SubCategory::WithTranslatedFields()->find($id);
            return $this->successResponse($subcategory, 'success');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
