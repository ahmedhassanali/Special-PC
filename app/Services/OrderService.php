<?php

namespace App\Services;
use App\Models\Area;
use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    use ApiResponser;

    public function index($status)
    {
        try {
            $customer =  Auth::guard('ecommerce')->user();

            if (!$customer) {
                return redirect()->back()->with('error','Customer not found');
            }

            $orders = $customer->orders;

            if (isset($status)) {
                if ($status == Order::RUNNING) {
                    $customer_orders = $orders->filter(function ($order) {
                        $firstItem = $order->items->first();
                        $order->image = $firstItem->product->image;
                        $order->name = $firstItem->product->ar_name;
                        $order->address = $order->address;
                        return $order->status != Order::FINISHED && $order->status != Order::CANCELLED;
                    });
                } else {
                    $customer_orders = $orders->filter(function ($order) use ($status) {
                        $firstItem = $order->items->first();
                        $order->image = $firstItem->product->image;
                        $order->name = $firstItem->product->ar_name;
                        $order->address = $order->address;
                        return $order->status == $status;
                    });
                }

                $orders = $customer_orders;
            }

            return  $orders;

        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function show($id)
    {
        try {
            $order = Order::with('address')->find($id);
            $order->address->city = City::where('id' , $order->address->city_id)->WithTranslatedFields()->first() ;
            $order->address->area = Area::where('id' , $order->address->area_id)->WithTranslatedFields()->first() ;

            foreach ($order->items as $item)
                $item->product = Product::where('id', $item->product_id)->WithTranslatedFields()->first();

            return $order;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function destroy($id)
    {
        try {
            $order = Order::find($id);
            $order->delete();
            return $this->successResponse($order, 'order deleted');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

}
