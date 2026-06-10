<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\ApiResponser;

class CategoryController extends Controller
{
    use ApiResponser;


    public function index()
    {
        try {
            $categories = Category::WithTranslatedFields()->get();
            $categories = $categories->map(function ($category) {
                $category->subCategories = SubCategory::where('category_id', $category->id)->WithTranslatedFields()->get();
                return $category;
            });
            return $this->successResponse($categories, 'All Categories');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function show($id)
    {
        try {
            $category = Category::WithTranslatedFields()->find($id);
            $products = Product::where('category_id', $category->id)->WithTranslatedFields()->get();
            $products = $products->map(function ($product){
                $product->rate =  $product->getAverageRating();
                return $product;
            });
            // $category->products = $products;
            // $category->subCategories =  SubCategory::where('category_id', $category->id)->WithTranslatedFields()->get();
            return $this->successResponse($products, 'success');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
