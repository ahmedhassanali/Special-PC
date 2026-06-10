<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Product;
use App\Services\ImageService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ApiResponser;

    public function addItem(Request $request)
    {
        try {
            $cart = Cart::where('customer_id',  $request->customer_id)->first();
            if (!$cart) {
                $cart = Cart::create([
                    'customer_id' => Auth()->user()->id,
                ]);
            }

            $existingItem = $cart->items()->where('product_id', $request->product_id)->first();

            if ($existingItem) {
                $existingItem->update([
                    'quantity' => $existingItem->quantity + $request->quantity,
                ]);
            } else {
                $request['cart_id'] = $cart->id;
                $cartItem = CartItem::create($request->all());
            }
            
            return $this->successResponse($cartItem, 'Product added to cart successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function removeItem($id)
    {
        try {
            $cartItem = CartItem::find($id);
            $cartItem->delete();
            return $this->successResponse(null, 'Product deleted to cart successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function show($id)
    {
        try {
            $customer = Customer::find($id);
            $cartItems = $customer->cart->items;
            $items = [];
            foreach ($cartItems as $item) {
                $item->product = Product::where('id', $item->product_id)->WithTranslatedFields()->first();
                $items[] = $item;
            }
            return $this->successResponse($cartItems, 'Cart Items');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function updateItemQuantity($id, Request $request)
    {
        try {
            $item = CartItem::find($id);
            if ($request->quantity > $item->product->stock)
                return $this->errorResponse('Product stock is insufficient.', 404);
            $item->update($request->all());
            return $this->successResponse($item, 'Item updated successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
