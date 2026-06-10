<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Feedback;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function show($id)
    {
        try {
            $product = Product::where('id', $id)->WithTranslatedFields()->first();

            $feedbackCount = Feedback::where('product_id', $product->id)->count();

            if ($feedbackCount != 0) {
                $totalRating = Feedback::where('product_id', $product->id)->sum('rating');
                $product->rate = $totalRating / $feedbackCount;
                $product->save();
            } else {
                $product->rate = 0;
            }

            $product->ratingCount = Feedback::where('product_id', $product->id)->count();
            $product->category = Category::where('id', $product->category_id)->WithTranslatedFields()->first();
            $product->subCategory = SubCategory::where('id', $product->sub_category_id)->WithTranslatedFields()->first();
            $product->images = ProductImage::where('product_id', $product->id)->get();
            $product->brand = Brand::where('id', $product->brand_id)->WithTranslatedFields()->first();
            $product->unit = Unit::where('id', $product->unit_id)->WithTranslatedFields()->first();
            $product->offer = Offer::where('id', $product->offer_id)->WithTranslatedFields()->first();

            if ($product->offer) {
                if ($product->offer->type == Offer::PERSENTAGE) {
                    $product->discount = $product->offer->amount / 100;
                    $product->discount_price = $product->price - ($product->price * ($product->offer->amount / 100));
                } else {
                    $product->discount = $product->offer->amount;
                    $product->discount_price = $product->price - ($product->price * $product->offer->amount);
                }
            }

            $imagesArray = [];
            foreach ($product->images as $image) {
                $imagesArray[] = $image->image;
            }

            $feedbacksArray = [];
            $feedbackss = Feedback::where('product_id', $product->id)->WithFields()->get();
            foreach ($feedbackss as $feedback) {
                $customer = Customer::find($feedback->customer_id);
                $feedback['name'] = $customer->name;
                $feedback['image'] = $customer->image;
                $feedbacksArray[] = $feedback;
            }

            $product->images = $imagesArray;
            $product->feedbacks = $feedbacksArray;

           

            return view('ecommerce.product', compact('product'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function relatedProducts($id)
    {
        try {
            $product = Product::find($id);
            $products = Product::where('category_id', $product->category->id)->WithTranslatedFields()->get();
            $product->offer = Offer::where('id', $product->offer_id)->WithTranslatedFields()->first();

            return $this->successResponse($products, 'products', 200);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function productsWithOffersThisWeek()
    {
        try {
            $startOfWeek = now()->startOfWeek()->toDateString();
            $endOfWeek = now()->endOfWeek()->toDateString();

            $offersThisWeek = Offer::whereDate('start_date', '<=', $endOfWeek)
                ->whereDate('end_date', '>=', $startOfWeek)
                ->get();

            $offerIds = $offersThisWeek->pluck('id')->unique();
            $productsWithOffersThisWeek = Product::whereIn('offer_id', $offerIds)->with('offer')->get();

            return $this->successResponse($productsWithOffersThisWeek, 'products With Offers This Week');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $search = $request->input('search');
            $category = Category::WithTranslatedFields()->first();
            $products = Product::when($search, function ($queryBuilder, $search) {
                $queryBuilder->where(function ($innerQueryBuilder) use ($search) {
                    $innerQueryBuilder->where('ar_name', 'like', '%' . $search . '%')
                        ->orWhere('en_name', 'like', '%' . $search . '%')
                        ->orWhere('en_description', 'like', '%' . $search . '%')
                        ->orWhere('ar_description', 'like', '%' . $search . '%');
                });
            })->get();

            $filteredProducts = $products;
            return view('ecommerce.category.index', compact('filteredProducts', 'category'));
        } catch (\Exception $e) {

            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }
    public function filters(Request $request)
    {
        try {
            $brands = $request->input('brands');
            $rate = $request->input('rate');
            $subcategories = $request->input('subcategories');
            $brandsSelected = $brands;
            $subcategoriesSelected = $subcategories;
            $startPrice = $request->input('priceFrom');
            $endPrice = $request->input('priceTo');
            $category = Category::WithTranslatedFields()->find($request->category_id);
    
            $productsQuery = Product::join('categories', 'products.category_id', '=', 'categories.id')
                ->where('categories.id', $request->category_id)
                ->select('products.*');
    
            // Filter by brands
            if ($brands) {
                $productsQuery->whereIn('brand_id', $brands);
            }
    
            // Filter by subcategories
            if ($subcategories) {
                $productsQuery->whereIn('sub_category_id', $subcategories);
            }
    
            // Filter by rating
            if ($rate) {
                $productsQuery->where('rate', '>=', $rate);
            }
    
            // Filter by price range
            if ($startPrice) {
                $productsQuery->where('price', '>=', $startPrice);
            }
            if ($endPrice) {
                $productsQuery->where('price', '<=', $endPrice);
            }
    
            $filteredProducts = $productsQuery->get();
    
            return view('ecommerce.category.index', compact(
                'filteredProducts',
                'brandsSelected',
                'subcategoriesSelected',
                'rate',
                'startPrice',
                'endPrice',
                'category'
            ));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }
    

    public function arrange(Request $request)
    {
        try {
            $products = $request->input('products');
            $productsIds = json_decode($products, true);
            $allProducts = Product::whereIn('id', $productsIds)->paginate(10);
            $category = Category::WithTranslatedFields()->find($request->category_id);

            $dependon = $request->input('depend_on');

            if ($dependon == 'price_low_to_high') {
                $allProducts = $allProducts->sortBy('price');
            }

            if ($dependon == 'price_high_to_low') {
                $allProducts = $allProducts->sortByDesc('price');
            }

            if ($dependon == 'highest_rated') {
                $allProducts = $allProducts->sortByDesc('rate');
            }

            $filteredProducts = $allProducts;

            return view('ecommerce.category.index', compact('filteredProducts', 'dependon', 'category'));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }
}
