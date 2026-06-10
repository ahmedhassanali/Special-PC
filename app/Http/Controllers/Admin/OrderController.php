<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Captain;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $orders =  Order::get();
            return view('admin.order.index' , compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.order.create');
    }

    public function store(Request $request)
    {
        try {
            Order::create($request->all());
            return redirect()->route('admin.order.index')->with('success', 'تم حفظ القسم بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $order = Order::find($id);
        return view('admin.order.update' , compact('order'));
    }

    public function delivery($id)
    {
        $order = Order::find($id);
        $captains = Captain::where('status' , 1)->get();
        return view('admin.order.delivery' , compact('order','captains'));
    }

    public function updateDelivery($id , Request $request)
    {
        $order = Order::find($id);
        $order->update($request->all());
        $captains = Captain::where('status' , 1)->get();
        return view('admin.order.delivery' , compact('order','captains'));
    }

    public function show($id)
    {
        try {
            $order = Order::find($id);
            return view('admin.order.show' , compact('order'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $order = Order::find($id);
            $order->delete();
            return redirect()->route('admin.order.index')->with('success', 'تم حذف ');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
