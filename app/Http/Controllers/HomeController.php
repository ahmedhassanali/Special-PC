<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CustomerAddress;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kutia\Larafirebase\Facades\Larafirebase;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private OrderService $orderService)
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $settings = Setting::first();
        $categories = Category::get();
        $sliders = Slider::get();
        $freeShippingProducts = Product::where('free_shipping' , 1)->get();
        $specialOfferProducts = Product::where('special_offer' , 1)->get();
        $mostSellingProducts = Product::withCount('orderItems')->orderByDesc('order_items_count')->limit(10)->get();
        return view('ecommerce.home.index' , compact('settings'  ,'categories' , 'sliders' ,'freeShippingProducts' ,'specialOfferProducts','mostSellingProducts' ));
    }

    public function bestSellingProducts()
    {
        try {
            $bestSellingProducts = OrderItem::groupBy('product_id')
                ->selectRaw('product_id, SUM(quantity) as total_quantity')
                ->orderByDesc('total_quantity')
                ->limit(10)->get();

            return $bestSellingProducts;
        } catch (\Exception $e) {
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function offer()
    {
        try {
            $offerId = Offer::first()->id;
            $category = Category::WithTranslatedFields()->find(1);
            $filteredProducts = Product::where('offer_id' , $offerId)->get();
            return view('ecommerce.category.index', compact('filteredProducts', 'category'));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function about()
    {
        $settings = Setting::first();
        return view('ecommerce.about' , compact('settings'));
    }

    public function privacyTerms()
    {
        $settings = Setting::first();
        return view('ecommerce.privacyTerms' , compact('settings'));
    }

    public function cart()
    {
        $settings = Setting::first();
        return view('ecommerce.cart' , compact('settings'));
    }

    public function order()
    {
        $settings = Setting::first();
        $customer = Auth::guard('ecommerce')->user();
        $paymentCards = $customer->paymentCards;
        $addresses = CustomerAddress::where('customer_id', $customer->id)->get();

        $items = [];
        if ($customer->cart && count($customer->cart->items) > 0) {
            $cartItems = $customer->cart->items;
            foreach ($cartItems as $item) {
                $item->product = Product::where('id', $item->product_id)->WithTranslatedFields()->first();
                $items[] = $item;
            }
        }else{
            return redirect()->back()->with('error', 'لم يتم اضافة اي منتجات في العربة');
        }

        return view('ecommerce.order' , compact('settings' , 'paymentCards' , 'addresses' , 'items'));
    }

    public function favourites()
    {
        $customer = Auth::guard('ecommerce')->user();
        $products = $customer->favourites->map(function ($favourite) {
            return $favourite->product;
        });

        return view('ecommerce.favorites' , compact('products'));
    }

    public function profile()
    {
        $customer = Auth::guard('ecommerce')->user();
        $paymentCards = $customer->paymentCards;
        $addresses = CustomerAddress::where('customer_id', $customer->id)->get();
        $cancelledOrders = json_encode($this->orderService->index(Order::CANCELLED)) ;
        $completedOrders = json_encode($this->orderService->index(Order::FINISHED));
        $runningOrders = json_encode($this->orderService->index(Order::RUNNING));

        return view('ecommerce.profile.index' , compact('customer' , 'paymentCards' , 'addresses' ,'runningOrders','completedOrders','cancelledOrders'));
    }

    public function updateToken( Request $request ) {
        try {
            // update user fcm token

            if ( !auth()->user() ) {
                return response()->json( [
                    'success' => false,
                ] );
            } else {
                $user = User::find( auth()->user()->id );
                $user->fcm_token = $request->token;
                $user->save();

                return response()->json( [
                    'success' => true,
                ] );
            }

        } catch ( \Exception$e ) {
            report( $e );
            return response()->json( [
                'success' => false,
            ], 500 );
        }
    }

    public function notification( Request $request ) {
        $request->validate( [
            'title' => 'required',
            'message' => 'required',
        ] );

        try {
            $fcmTokens = User::whereNotNull( 'fcm_token' )->pluck( 'fcm_token' )->toArray();

            //Notification::send( null, new SendPushNotification( $request->title, $request->message, $fcmTokens ) );

            /* or */

            //auth()->user()->notify( new SendPushNotification( $title, $message, $fcmTokens ) );

            /* or */

            Larafirebase::withTitle( $request->title )
            ->withBody( $request->message )
            ->sendMessage( $fcmTokens );

            return redirect()->back()->with( 'success', 'Notification Sent Successfully!!' );

        } catch ( \Exception$e ) {
            report( $e );
            return redirect()->back()->with( 'error', 'Something goes wrong while sending notification.' );
        }
    }
}
