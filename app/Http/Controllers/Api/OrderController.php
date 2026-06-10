<?php

namespace App\Http\Controllers\Api;

use App\Events\NewOrderEvent;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\CartItem;
use App\Models\City;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewOrderAddedNotification;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{

    use ApiResponser;

    public function index($id, Request $request)
    {
        try {
            $customer = Customer::find($id);

            if (!$customer) {
                return $this->errorResponse('Customer not found', 404);
            }

            $orders = $customer->orders;

            if ($request->has('status')) {

                $status = $request->status;
                if ($status == Order::RUNNING) {

                    $customer_orders = $orders->filter(function ($order) {
                        $firstItem = $order->items->first();
                        $order->image = $firstItem->product->image;
                        $order->address = $order->address;
                        return $order->status != Order::FINISHED && $order->status != Order::CANCELLED;

                    });

                } else {

                    $customer_orders = $orders->filter(function ($order) use ($status) {
                        $firstItem = $order->items->first();
                        $order->image = $firstItem->product->image;
                        $order->address = $order->address;
                        return $order->status == $status;
                    });

                }

                $orders = $customer_orders;

            }

            return $this->successResponse($orders, 'Customer orders');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function store(Request $request)
    {
        try {
            $customer = Customer::find($request->customer_id);
            if (!$customer) {
                return $this->errorResponse('Customer not found', 404);
            }

            $cartItems = $customer->cart->items;
            $total = 0;

            foreach ($cartItems as $item) {
                $total += $item->quantity * $item->product->price;
            }

            $address = CustomerAddress::find($request->customer_address_id);
            $order = Order::create([
                'customer_id' => $request->customer_id,
                'customer_address_id' => $request->customer_address_id,
                'shipping_fees' => $address->area->delivery_fees,
                'total' => $total,
                'status' => Order::PREORDERED
            ]);


            foreach ($cartItems as $item) {

                $item = CartItem::find($item->id);
                $item->delete();

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                ]);

            }


            

            $admins = User::where('role' , 1)->get();
            Notification::send($admins, new NewOrderAddedNotification($order));


            NewOrderEvent::dispatch($order);
            return $this->successResponse($order, 'Cart Items');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
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

            return $this->successResponse($order, 'view order');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $order = Order::find($id);
            $order->delete();
            return $this->successResponse($order, 'order deleted');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
