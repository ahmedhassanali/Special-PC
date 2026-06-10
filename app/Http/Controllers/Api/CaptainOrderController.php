<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Captain;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class CaptainOrderController extends Controller
{

    use ApiResponser;

    public function index($id, Request $request)
    {
        try {
            $captain = Captain::find($id);

            if (!$captain) {
                return $this->errorResponse('Captain Not Found', 404);
            }

            $orders = $captain->orders;

            if ($request->has('status')) {
                $status = $request->status;

                if ($status == Order::RUNNING) {
                    $captain_orders = $orders->filter(function ($order) {
                        $firstItem = $order->items->first();
                        $order->image = $firstItem->product->image;
                        $order->address = $order->address;
                        return $order->status != Order::DELIVERED && $order->status != Order::CANCELLED;
                    });
                } elseif ($status == Order::COMPLETED) {
                    $captain_orders = $orders->filter(function ($order) {
                        $firstItem = $order->items->first();
                        $order->image = $firstItem->product->image;
                        $order->address = $order->address;
                        return $order->status == Order::DELIVERED || $order->status == Order::CANCELLED;
                    });
                } else {
                    $captain_orders = $orders->filter(function ($order) use ($status) {
                        $firstItem = $order->items->first();
                        $order->image = $firstItem->product->image;
                        $order->address = $order->address;
                        return $order->status == $status;
                    });
                }

                $orders = $captain_orders;
            }

            return $this->successResponse($orders, 'Captain Orders');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function show($id)
    {
        try {
            $order = Order::find($id);

            foreach ($order->items as $item)
                $item->product = Product::where('id', $item->product_id)->WithTranslatedFields()->first();

            return $this->successResponse($order, 'View Order');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function updateStatus($id, Request $request)
    {
        try {
            $order = Order::find($id);
            $order->status = $request->status;
            $order->save();
            
            foreach ($order->items as $item)
                $item->product = Product::where('id', $item->product_id)->WithTranslatedFields()->first();

            return $this->successResponse($order, 'Status Changed Successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
