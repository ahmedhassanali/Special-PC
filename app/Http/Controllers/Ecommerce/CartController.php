<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addItem(Request $request)
    {
        try {
            // Check if the user is authenticated
            $customer = Auth::guard('ecommerce')->user();
    
            // For authenticated users, store in the database
            if ($customer) {
                $cart = Cart::firstOrCreate(['customer_id' => $customer->id]);
    
                $existingItem = $cart->items()->where('product_id', $request->product_id)->first();
    
                if ($existingItem) {
                    $existingItem->update(['quantity' => $existingItem->quantity + $request->quantity]);
                } else {
                    $cart->items()->create([
                        'product_id' => $request->product_id,
                        'quantity' => $request->quantity,
                        'referrer_id' => session('referrer_id', null)
                    ]);
                }
            } else {
                // For guest users, use session to store cart items
                $cartItems = session('cart_items', []);
    
                $existingItemKey = array_search($request->product_id, array_column($cartItems, 'product_id'));
    
                if ($existingItemKey !== false) {
                    $cartItems[$existingItemKey]['quantity'] += $request->quantity;
                } else {
                    $cartItems[] = [
                        'product_id' => $request->product_id,
                        'quantity' => $request->quantity
                    ];
                }
    
                // Save cart items in session
                session(['cart_items' => $cartItems]);
            }
    
            return response()->json(['success' => true]);
    
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    

    public function removeItem($id)
    {
        try {
            $cartItem = CartItem::find($id);
            $cartItem->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function show()
    {
        try {
            $customer = Auth::guard('ecommerce')->user();
            $setting = Setting::first();
    
            $items = [];
    
            // If the user is authenticated, fetch from the database
            if ($customer) {
                $cartItems = $customer->cart->items ?? [];
                foreach ($cartItems as $item) {
                    $item->product = Product::where('id', $item->product_id)->withTranslatedFields()->first();
                    $items[] = $item;
                }
            } else {
                // If the user is not authenticated, fetch from the session
                $cartItems = session('cart_items', []);
                foreach ($cartItems as $cartItem) {
                    $product = Product::where('id', $cartItem['product_id'])->withTranslatedFields()->first();
                    if ($product) {
                        $cartItem['product'] = $product;
                        $items[] = (object) $cartItem;  // Convert array to object
                    }
                }
            }
    
            return view('ecommerce.cart', compact('items', 'setting'));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }
    

    public function updateItemQuantity(Request $request)
    {
            try {
                $item = CartItem::find($request->product_id);

                if (!$item) {
                    return response()->json(['success' => false, 'message' => 'Cart item not found.'], 404);
                }

                $requestedQuantity = $request->quantity;

                if (!is_numeric($requestedQuantity) || $requestedQuantity < 1 || floor($requestedQuantity) != $requestedQuantity) {
                    return response()->json(['success' => false, 'message' => 'Invalid quantity. Please enter a positive integer.'], 400);
                }

                if ($requestedQuantity > $item->product->stock) {
                    return response()->json(['success' => false, 'message' => 'لا يوجد عدد كافٍ في المنتج. يرجى طلب عدد اقل'], 400);
                }

                $item->update(['quantity' => $requestedQuantity]);

                return response()->json(['success' => true, 'message' => 'Quantity updated successfully.']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
    }
}
