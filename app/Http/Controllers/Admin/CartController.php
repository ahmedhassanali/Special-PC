<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Setting;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('customer', 'items')->get();
        $setting = Setting::first();

        return view('admin.cart.index', compact('carts', 'setting'));
    }
}
