<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class CategoryController extends Controller
{
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
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function show($id)
    {
        try {
            $category = Category::WithTranslatedFields()->find($id);
            $products = Product::where('category_id', $category->id)->get();

            $filteredProducts = $products->map(function ($product) {
                $product->rate =  $product->getAverageRating();
                if($product->rate)
                $product->save();
                return $product;
            });

            return view('ecommerce.category.index', compact('filteredProducts', 'category'));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }


}
