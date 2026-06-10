<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller {
    // dashboard page

    public function index() {

        $numOfOrdersToday = Order::whereDate('created_at', Carbon::today())->count();
        $numOfOrdersThisMonth = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();

        $totalOrderAmountToday = Order::whereDate('created_at', Carbon::today())->sum('total');
        $totalOrderAmountToday = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('total');


        return view( 'admin.index' , compact('numOfOrdersToday' , 'numOfOrdersThisMonth' , 'totalOrderAmountToday' , 'totalOrderAmountToday') );
    }
}
