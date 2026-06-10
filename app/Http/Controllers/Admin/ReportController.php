<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller {
    // dashboard page

    public function index(Request $request)
    {
        $end = '2150-01-02';
        $start = '1990-01-01';

        if (isset($request->startDate)) {
            $selectedDate = $request->startDate;
            $start = $selectedDate . ' 00:00:00';
        }

        if (isset($request->endDate)) {
            $selectedDate = $request->endDate;
            $end = $selectedDate . ' 00:00:00';
        }

        $products = Product::whereBetween('created_at', [$start, $end])->count();

        $maleCustomer = Customer::where('gender', Customer::MALE)->whereBetween('created_at', [$start, $end])->count();
        $femaleCustomer = Customer::where('gender', Customer::FEMALE)->whereBetween('created_at', [$start, $end])->count();

        $numOfOrders      = Order::whereBetween('created_at', [$start, $end])->count();
        $numOfcategories  = Category::whereBetween('created_at', [$start, $end])->count();
        $totalOrderAmount = Order::whereBetween('created_at', [$start, $end])->sum('total');

        $topRatedProducts = Product::orderByDesc('rate')
        ->take(5)
        ->whereBetween('created_at', [$start, $end])
        ->get();

        return view( 'admin.report.index' , compact('products' , 'maleCustomer' , 'femaleCustomer' , 'numOfOrders' ,'totalOrderAmount' , 'topRatedProducts' , 'numOfcategories') );
    }
}
