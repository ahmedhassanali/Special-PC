<?php
namespace App\Http\Controllers\Api\Payment;

use App\Events\NewOrderEvent;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Marketer;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\NewOrderAddedNotification;
use App\Services\Delivry\TorodService;
use App\Services\Payment\TapPayment;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class TapPaymentController extends Controller {
    use ApiResponser;

    public function charge( Request $request ) {

        try {
            $customer = Customer::find( $request->customer_id );
            $setting = Setting::first();
            $tax = $setting->tax;
            $fee = $setting->service_fee;
            if ( !$customer ) {
                return $this->errorResponse( 'Customer not found', 404 );
            }

            $cartItems = $customer->cart->items;
            $total = 0;

            foreach ( $cartItems as $item ) {
                $total += $item->quantity * $item->product->price;
            }

            $address = CustomerAddress::find( $request->customer_address_id );
            $referrerId = $cartItems->first()->referrer_id ?? null;

            $order = Order::create( [
                'customer_id' => $request->customer_id,
                'customer_address_id' => $request->customer_address_id,
                'shipping_fees' => $address->area->delivery_fees,
                'total' => $total,
                'status' => Order::PREORDERED,
                'marketer_id' => $referrerId, // Associate marketer with the order
            ] );

            if ( $order ) {
                //  $offer = Offer::find( $order->offer_id );

                $amount = 0;
                $discount = 0;

                $orderPrice = $this->calculateTotalPrice( $cartItems, $request->couponAmount ?? 0, $address );

                //    $discount = $this->couponCheck( $request, $offerPrice, $order );

                $amount = $orderPrice - $discount;
                $wallet_amount = 0;

                if ( $order->customer->wallet > 0 && isset( $request->use_wallet ) && $request->use_wallet == 1 ) {
                    $wallet_amount = $order->customer->wallet;
                    $amount = $amount - $wallet_amount;
                }

                $requestData = '';

                // add coupon information to the request
                if ( $request->coupon_id && $discount > 0 ) {
                    $requestData .= '&coupon_id=' . $request->coupon_id . '&coupon_amount=' . $discount;
                }

                // add wallet information to the request
                if ( $wallet_amount > 0 ) {
                    $requestData .= '&wallet_amount=' . $wallet_amount;
                }

                // add customer_address_id information to the request
                if ( $request->customer_address_id ) {
                    $requestData .= '&customer_address_id=' . $request->customer_address_id;
                }

                if ( $referrerId ) {
                    $requestData .= '&ref=' . $referrerId;
                }

                $appUrl = env( 'APP_URL' );
                $PostCallback = $appUrl . '/v1/client/paymentPostCallback?offer_id=' . $order->offer_id . '&customer_id=' . $order->customer_id . '&amount=' . $amount - $discount . 'order_id=' . $order->id . $requestData;
                $GetCallback = $appUrl . '/v1/client/paymentCallback?offer_id=' . $order->offer_id . '&customer_id=' . $order->customer_id . '&amount=' . $amount - $discount . '&order_id=' . $order->id . $requestData;
                $description = 'new order with ' . $order->id;
                $first_name = $order->customer->name;
                $email = $order->customer->email;
                $phone = $order->customer->phone;
                $transaction_id = rand( 1000, 9999 );

                $tap_payment = new TapPayment();
                $tap_payment = $tap_payment->charge( $PostCallback, $GetCallback, $amount, $discount, $description, $first_name, 'spc1999250@gmail.com', $phone, $tax, $transaction_id );

                return $tap_payment;
            }

        } catch ( \Exception $e ) {
            return $this->errorResponse( $e->getMessage(), $e->getCode() );
        }
    }

    public function checkout( $id ) {
        $tap_payment = new TapPayment();
        $tap_payment = $tap_payment->checkout( $id );
        return $tap_payment;
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

    public function couponCheck( Request $request, $offerPrice, $order ) {
        $discount = 0;

        if ( $request->coupon_id ) {
            $check = Coupon::find( $request->coupon_id );
            if ( !$check || $check->status == 0 || $check->end_at && $check->end_at <= date( 'Y-m-d' ) ) {
                return response()->json( [
                    'status' => 'error',
                    'message' => __( 'Sorry ,Coupon is not valid!' ),
                ], 401 );
            } elseif ( $check->offer_id && $check->offer_id != $order->offer_id ) {
                return response()->json( [
                    'status' => 'error',
                    'message' => __( 'Sorry ,Coupon is not valid for this offer!' ),
                ], 401 );
            } else {
                if ( $check->type == 'value' ) {
                    $discount = $check->amount;
                } else {
                    $discount = $check->amount * $offerPrice / 100;
                }
            }
        }

        return $discount;
    }

    public function paymentCallback( Request $request ) {
        if ( $request->tap_id ) {
            $check = $this->checkout( $request->tap_id );

            if ( $check->status == 'DECLINED' ) {
                //    return $check->response->message;
                return $this->errorResponse( 'Error In Payment : ' . $check->response->message, 500 );

            } else if ( $check->status == 'INITIATED' ) {
                $this->reserve( $request );
                $order = Order::find( $request->order_id );
                $customer = Customer::find( $request->customer_id );
                $cartItems = $customer->cart->items;
                $this->clearCartItems( $cartItems );
                $this->notifyAdmins( $order );

                return redirect()->route( 'customer.order.show', $order->id );
            } else if ( $check->status == 'CAPTURED' ) {
                $this->reserve( $request );
                $order = Order::find( $request->order_id );
                $customer = Customer::find( $request->customer_id );
                $cartItems = $customer->cart->items;
                $this->clearCartItems( $cartItems );
                $this->notifyAdmins( $order );

                return redirect()->route( 'customer.order.show', $order->id );
            } else {
                return $check;
            }
        }
    }

    // function createInvoicePDF( $reportHtml, $order ) {
    //     $arabic = new Arabic();
    //     $p = $arabic->arIdentify( $reportHtml );

    //     for (
    //         $i = count( $p ) - 1;
    //         $i >= 0;
    //         $i -= 2
    // ) {
    //         $utf8ar = $arabic->utf8Glyphs( substr( $reportHtml, $p[ $i - 1 ], $p[ $i ] - $p[ $i - 1 ] ) );
    //         $reportHtml = substr_replace( $reportHtml, $utf8ar, $p[ $i - 1 ], $p[ $i ] - $p[ $i - 1 ] );
    //     }

    //     $pdf = PDF::loadHTML( $reportHtml );
    //     $pdf->save( 'storage/pdf/' . $order->id . '_' . $order->customer->id . '.pdf' );
    //     $link =  '/storage/pdf/' . $order->id . '_' . $order->customer->id . '.pdf';
    //     $baseURL = env( 'APP_URL', 'https://special-pc.com/.com/' );
    //     return  $baseURL . $link;
    // }

    public function reserve( Request $request ) {

        try {
            $customer = Customer::find( $request->customer_id );
            $setting = Setting::first();
            $order = Order::find( $request->order_id );

            $tax = $setting->tax;
            $fee = $setting->service_fee;

            if ( !$customer ) {
                return $this->errorResponse( 'Customer not found', 404 );
            }

            $cartItems = $customer->cart->items;
            $total = 0;

            foreach ( $cartItems as $item ) {
                $total += $item->quantity * $item->product->price;
            }

            $address = CustomerAddress::find( $request->customer_address_id );
            $totalQ = 0;
            $totalW = 0;
            if ( $order ) {

                foreach ( $cartItems as $cartItem ) {
                    $order->items()->create( [
                        'product_id' => $cartItem->product_id,
                        'quantity' => $cartItem->quantity,
                    ] );

                    $totalW += ( $cartItem->weight * $cartItem->quantity );
                }

                $payment = new Payment();
                //  $payment->payment_id = $request->tap_id;
                $payment->amount = $request->amount;
                $payment->payment_method = 'Card';
                $payment->payment_status = 'paid';
                $payment->customer_id = $order->customer_id;

                if ( isset( $request->coupon_id ) ) {
                    $payment->coupon_id = $request->coupon_id;
                    $payment->coupon_amount = $request->coupon_amount;
                }
                //   $payment->service_fee =  $fee;
                //    $payment->tax =  $tax;
                $payment->order_id = $order->id;

                $payment->save();

                $order->paid = 1;
                $order->status = Order::PREORDERED;
                // Associate marketer if ref param is present
                if ( $request->has( 'ref' ) ) {
                    $marketer = Marketer::find( $request->input( 'ref' ) );
                    if ( $marketer ) {
                        $marketer->increment( 'total_profit', $total * 0.1 );
                        // Assuming 10% commission
                    }
                }

                $order->save();

                // Create order on Torod
                $orderData = [
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'phone_number' => $address->phone,
                    'item_description' => 'PC Item', // Example item description
                    'order_total' => $total,
                    'payment' => 'Prepaid', // Assuming the payment method
                    'weight' => $totalW, // Example weight
                    'no_of_box' => 1, // Example number of boxes
                    'type' => 'address', // Example type
                    'locate_address' => $address->address,
                ];

                $torodService = new TorodService();
                $torodOrderResponse = $torodService->createOrder( $orderData );

                Log::debug( $torodOrderResponse );

                // Optionally handle the response from Torod
                if ( $torodOrderResponse[ 'status' ] ) {

                    $admins = User::where( 'role', 1 )->get();
                    Notification::send( $admins, new NewOrderAddedNotification( $order ) );

                    NewOrderEvent::dispatch( $order );
                    return response()->json( [
                        'status' => 'success',
                        'message' => 'Offer added to reservations and order created on Torod',
                    ] );
                } else {
                    return $this->errorResponse( 'Failed to create order on Torod', 500 );
                }

            }
        } catch ( \Exception $e ) {
            return $this->errorResponse( $e->getMessage(), $e->getCode() );
        }

    }

    private function clearCartItems( $cartItems ) {
        foreach ( $cartItems as $item ) {
            $item->delete();
        }
    }

    private function notifyAdmins( $order ) {
        $admins = User::where( 'role', 1 )->get();
        //  Notification::send( $admins, new NewOrderAddedNotification( $order ) );
        // NewOrderEvent::dispatch( $order );
    }

}
