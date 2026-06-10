<?php

namespace App\Http\Controllers\Ecommerce;

use App\Events\NewOrderEvent;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\CartItem;
use App\Models\City;
use App\Models\CustomerAddress;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Models\Marketer;
use App\Services\Delivry\TorodService;
use App\Notifications\NewOrderAddedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {
    public function store( Request $request ) {
        $customer = Auth::guard( 'ecommerce' )->user();

        if ( !$customer ) {
            return redirect()->back()->with( 'error', 'Customer not found' );
        }

        $cartItems = $customer->cart->items;
        $address = CustomerAddress::find( $request->customer_address_id );

        if ( !$address ) {
            return redirect()->back()->with( 'error', 'Address not found' );
        }

        $total = $this->calculateTotalPrice( $cartItems, $request->couponAmount ?? 0, $address );

        // Retrieve the referrer ID from the cart items
        $referrerId = $cartItems->first()->referrer_id ?? null;

        if ( $request->payment_type == 'wallet' ) {
            if ( $this->checkWalletBalance( $customer, $total ) ) {
                $this->deductFromWallet( $customer, $total );
                $order = $this->createOrder( $customer, $request->customer_address_id, $total, $address, $cartItems, $referrerId );
                $this->createPayment( $customer, $order->id, $total, 'Wallet' );
            } else {
                return redirect()->back()->with( 'error', 'Insufficient wallet balance' );
            }
        } elseif ( $request->payment_type == 'cash' ) {
            $order = $this->createOrder( $customer, $request->customer_address_id, $total, $address, $cartItems, $referrerId );
            $this->createPayment( $customer, $order->id, $total, 'Cash' );
        } elseif ( $request->payment_type == 'card' ) {
            $order = $this->createOrder( $customer, $request->customer_address_id, $total, $address, $cartItems, $referrerId );
            $this->createPayment( $customer, $order->id, $total, 'Card' );
        } else {
            return redirect()->back()->with( 'error', 'Invalid payment method' );
        }

        $this->clearCartItems( $cartItems );
        $this->notifyAdmins( $order );

        // Clear the referrer ID from the session after the order is placed
        session()->forget( 'referrer_id' );

        return redirect()->route( 'ecommerce.cart.show' )->with( 'success', 'Order placed successfully' );
    }

    private function calculateTotalPrice( $cartItems, $couponAmount, $address ) {
        $settings = Setting::first();

        $total = 0;
        foreach ( $cartItems as $item ) {
            $price = $item->product->price;
            if ( $item->product->offer ) {
                if ( $item->product->offer->type == Offer::VALUE ) {
                    $price -= $item->product->offer->amount;
                } else {
                    $price *= ( 1 - $item->product->offer->amount / 100 );
                }
            }
            $total += $price * $item->quantity;
        }

        $total -= $couponAmount;
        if ( $settings && isset( $settings->tax ) ) {
            $total += $total * ( $settings->tax / 100 );
        }

        $total += $address->area->delivery_fees;

        return $total;
    }

    private function checkWalletBalance( $customer, $total ) {
        return $customer->wallet >= $total;
    }

    private function deductFromWallet( $customer, $total ) {
        $customer->wallet -= $total;
        $customer->save();
    }

    private function createOrder( $customer, $addressId, $total, $address, $cartItems, $referrerId = null ) {
        $order = Order::create( [
            'customer_id' => $customer->id,
            'customer_address_id' => $addressId,
            'shipping_fees' => $address->area->delivery_fees,
            'total' => $total,
            'status' => Order::PREORDERED,
            'marketer_id' => $referrerId, // Associate marketer with the order
        ] );

        $totalQ = 0;
        $totalW = 0;

        if ( $order ) {
            foreach ( $cartItems as $cartItem ) {
                $order->items()->create( [
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                ] );
                $totalW +=  ( $cartItem->weight * $cartItem->quantity );
            }

            if ( $referrerId ) {
                $marketer = Marketer::find( $referrerId );
                if ( $marketer ) {
                    $marketer->increment( 'total_profit', $total * 0.1 );
                    // Assuming 10% commission
                }
            }

            // Create order on Torod
            $orderData = [
                'name' => $customer->name,
                'email' => $customer->email,
                'phone_number' => $address->phone,
                'item_description' => 'PC Product', // Example item description
                'order_total' => $total,
                'payment' => 'Cod', // Assuming the payment method
                'weight' => $totalW, // Example weight
                'no_of_box' => 1, // Example number of boxes
                'type' => 'address', // Example type
                'locate_address' => $address->address,
            ];

            $torodService = new TorodService();
            $torodOrderResponse = $torodService->createOrder( $orderData );
        }

        return $order;
    }

    private function createPayment( $customer, $orderId, $total, $payment_method ) {
        $payment = Payment::create( [
            'customer_id' => $customer->id,
            'order_id' => $orderId,
            'amount' => $total,
            'payment_method' => $payment_method,
            'payment_status' => 'paid',
        ] );

        return $payment;
    }

    private function clearCartItems( $cartItems ) {
        foreach ( $cartItems as $item ) {
            $item->delete();
        }
    }

    private function notifyAdmins( $order ) {
        $admins = User::where( 'role', 1 )->get();
        Notification::send( $admins, new NewOrderAddedNotification( $order ) );
        NewOrderEvent::dispatch( $order );
    }

    public function show( $id ) {
        try {
            $order = Order::with( 'address' )->find( $id );
            if ( !$order ) {
                throw new \Exception( 'Order not found' );
            }
            $order->address->city = City::where( 'id', $order->address->city_id )->WithTranslatedFields()->first();
            $order->address->area = Area::where( 'id', $order->address->area_id )->WithTranslatedFields()->first();

            foreach ( $order->items as $item ) {
                $item->product = Product::where( 'id', $item->product_id )->WithTranslatedFields()->first();
            }

            return view( 'ecommerce.order-details', compact( 'order' ) );
        } catch ( \Exception $e ) {
            $message = $e->getMessage();
            return view( 'ecommerce.layouts.catch', compact( 'message' ) );
        }
    }

    public function destroy( $id ) {
        try {
            $order = Order::find( $id );
            if ( $order ) {
                $order->delete();
                return $this->successResponse( $order, 'Order deleted' );
            } else {
                throw new \Exception( 'Order not found' );
            }
        } catch ( \Exception $e ) {
            $message = $e->getMessage();
            return view( 'ecommerce.layouts.catch', compact( 'message' ) );
        }
    }
}
