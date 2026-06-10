<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Favorite;
use App\Models\Product;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    use ApiResponser;

    public function favorite(Request $request)
    {
        try{
            $favorite = Favorite::where('product_id', $request->product_id)->where('customer_id', $request->customer_id)->first();
            if ($favorite){
                $favorite->delete();
                return $this->successResponse(null, 'Product Removed from Favorites');
            } else {
                $favorite = new Favorite;
                $favorite->product_id = $request->product_id;
                $favorite->customer_id = $request->customer_id;
                $favorite->save();
                return $this->successResponse($favorite, 'Product Added to Favorites');
            }
        } catch (\Exception $e){
                return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function favorites($customer_id)
    {
        try {
            $customer = Customer::find($customer_id);
            if (!$customer) {
                return $this->errorResponse('Customer not found', 404);
            }

            $favorites = Favorite::where('customer_id', $customer_id)->get();
            $processedFavorites = [];
            foreach ($favorites as $favorite) {
                $processedFavorites[] = Product::where('id' , $favorite->product_id)->WithTranslatedFields()->first();
            }
            return $this->successResponse($processedFavorites, 'All Customer favorite Products');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
