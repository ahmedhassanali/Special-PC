<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Feedback;
use App\Models\Offer;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\Unit;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    use ApiResponser;

    public function show($id)
    {
        try {
            $product =  Product::where('id', $id)->WithTranslatedFields()->first();

            if (Feedback::where('product_id', $product->id)->count() != 0) {
                $product->rating = Feedback::where('product_id', $product->id)->sum('rating') / Feedback::where('product_id', $product->id)->count();
            } else
                $product->rating = 0;

            $product->ratingCount = Feedback::where('product_id', $product->id)->count();
            $product->category = Category::where('id', $product->category_id)->WithTranslatedFields()->first();
            $product->subCategory = SubCategory::where('id', $product->sub_category_id)->WithTranslatedFields()->first();
            $product->images  = ProductImage::where('product_id', $product->id)->get();
            $product->brand = Brand::where('id', $product->brand_id)->WithTranslatedFields()->first();
            $product->unit = Unit::where('id', $product->unit_id)->WithTranslatedFields()->first();
            $product->offer = Offer::where('id', $product->offer_id)->WithTranslatedFields()->first();

            if($product->offer){
                if($product->offer->type == Offer::PERSENTAGE){
                    $product->discount = $product->offer->amount / 100;
                    $product->discount_price =  $product->price - ($product->price * ($product->offer->amount / 100));
                }else{
                    $product->discount = $product->offer->amount;
                    $product->discount_price =  $product->price - ($product->price * $product->offer->amount);
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

            return $this->successResponse($product, 'product', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function relatedProducts($id)
    {
        try {
            $product =  Product::find($id);
            $products = Product::where('category_id', $product->category->id)->WithTranslatedFields()->get();
            $product->offer = Offer::where('id', $product->offer_id)->WithTranslatedFields()->first();

            return $this->successResponse($products, 'products', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
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
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }


    public function bestSellingProducts()
    {
        try {
            $bestSellingProductIds = OrderItem::groupBy('product_id')
                ->selectRaw('product_id, SUM(quantity) as total_quantity')
                ->orderByDesc('total_quantity')
                ->limit(10)
                ->pluck('product_id');

            $bestSellingProducts = Product::whereIn('id', $bestSellingProductIds)
            ->with(['category' => function ($query) {$query->withTranslatedFields();},
                'subCategory' => function ($query) {$query->withTranslatedFields();},
                'brand' => function ($query) {$query->withTranslatedFields();},
                'unit' => function ($query) {$query->withTranslatedFields();},
                'offer' => function ($query) {$query->withTranslatedFields();},
                'images'])->withTranslatedFields()->get();

            return $this->successResponse($bestSellingProducts, 'Best Selling Products', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function search(Request $request)
    {
        try {
            $name = $request->input('name');
            $category_id = $request->input('category_id');
            $sub_category_id = $request->input('sub_category_id');

            $products = Product::WithTranslatedFields()->when($name, function ($queryBuilder, $name) {
                $queryBuilder->where(function ($innerQueryBuilder) use ($name) {
                    $innerQueryBuilder->where('ar_name', 'like', '%' . $name . '%')
                        ->orWhere('en_name', 'like', '%' . $name . '%');
                });
            })
            ->when($category_id, function ($queryBuilder, $category_id) {
                $queryBuilder->where('category_id', $category_id);
            })
            ->when($sub_category_id, function ($queryBuilder, $sub_category_id) {
                $queryBuilder->where('sub_category_id', $sub_category_id);
            })
            ->get();


            return $this->successResponse($products, 'Filtered products');

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
