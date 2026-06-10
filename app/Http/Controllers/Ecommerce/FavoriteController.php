<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{


    public function favorite(Request $request)
    {
        try {
            $favorite = Favorite::where('product_id', $request->product_id)
                                ->where('customer_id', $request->customer_id)
                                ->first();
            if ($favorite) {
                $favorite->delete();
            } else {
                $favorite = new Favorite;
                $favorite->product_id = $request->product_id;
                $favorite->customer_id = $request->customer_id;
                $favorite->save();
            }

            // Return a JSON response indicating success
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Return a JSON response indicating failure with the error message
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function favorites($customer_id)
    {
        try {
            $customer = Customer::find($customer_id);
            if (!$customer) {
                return   redirect()->back()->with('error', 'Customer not found');
            }
            $favorites = Favorite::where('customer_id', $customer_id)->get();

            $processedFavorites = [];
            foreach ($favorites as $favorite) {
                $processedFavorites[] = Product::where('id', $favorite->product_id)->WithTranslatedFields()->first();
            }
            return view('ecommerce.favorites', compact('processedFavorites'));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }
}
