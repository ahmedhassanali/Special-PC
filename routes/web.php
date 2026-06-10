<?php

use App\Http\Controllers\Api\Payment\TapPaymentController;
use App\Http\Controllers\Ecommerce\AuthController;
use App\Http\Controllers\Ecommerce\BlogController;
use App\Http\Controllers\Ecommerce\CartController;
use App\Http\Controllers\Ecommerce\CategoryController;
use App\Http\Controllers\Ecommerce\CouponController;
use App\Http\Controllers\Ecommerce\CustomerAddressController;
use App\Http\Controllers\Ecommerce\CustomerController;
use App\Http\Controllers\Ecommerce\FavoriteController;
use App\Http\Controllers\Ecommerce\OrderController;
use App\Http\Controllers\Ecommerce\PaymentCardController;
use App\Http\Controllers\Ecommerce\ProductController;
use App\Http\Controllers\Ecommerce\ConsultationController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReferralController;
use App\Services\Delivry\TorodService;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Auth::routes();

Route::get('/ref/{ref}', [ReferralController::class, 'handleReferral'])
    ->name('ref')
    ->middleware('referral');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/consultation', [ConsultationController::class, 'index'])->name('consultation');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/privacyTerms', [App\Http\Controllers\HomeController::class, 'privacyTerms'])->name('privacyTerms');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/offer', [App\Http\Controllers\HomeController::class, 'offer'])->name('offer');

Route::post('client/login', [App\Http\Controllers\Ecommerce\AuthController::class, 'login'])->name('client.login');
Route::get('ecommerce/login', [App\Http\Controllers\Ecommerce\AuthController::class, 'LoginForm'])->name('ecommerce.login');
Route::get('ecommerce/register', [App\Http\Controllers\Ecommerce\AuthController::class, 'registerForm'])->name('ecommerce.register');
Route::post('client/register', [App\Http\Controllers\Ecommerce\AuthController::class, 'register'])->name('client.register');
Route::get('ecommerce/forgot/password', [App\Http\Controllers\Ecommerce\AuthController::class, 'forgotPasswordForm'])->name('ecommerce.forgotPassword');

Route::post('/reset/password/email', [AuthController::class, 'resetPasswordEmail'])->name('ecommerce.resetPasswordEmail');
Route::post('/reset/password/check/code', [AuthController::class, 'resetPasswordCheckCode'])->name('ecommerce.resetPasswordCheckCode');
Route::get('password/code', [AuthController::class, 'passwordCodeForm'])->name('ecommerce.passwordCodeForm');
Route::post('/new/client/password', [AuthController::class, 'newPassword'])->name('ecommerce.newPassword');

Route::post('/send/verification/email', [AuthController::class, 'sendVerificationEmail'])->name('ecommerce.sendVerificationEmail');
Route::post('/check/verification/code', [AuthController::class, 'checkVerificationCode'])->name('ecommerce.checkVerificationCode');
Route::get('/verificationCode/form', [AuthController::class, 'verificationCodeForm'])->name('ecommerce.verificationCodeForm');
Route::get('send/verificationCode/email/form', [AuthController::class, 'sendEmailForm'])->name('ecommerce.verificationCode.email.Form');

Route::get('/category/{id}', [CategoryController::class, 'show'])->name('ecommerce.category.show');

Route::middleware('referral')->group(function () {
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('ecommerce.product.show');
    Route::post('order/store', [OrderController::class, 'store'])->name('customer.order.store');
    Route::post('cart/add', [CartController::class, 'addItem'])->name('ecommerce.cart.addItem');
    Route::get('customer/cart', [CartController::class, 'show'])->name('ecommerce.cart.show')->middleware('auth.ecommerce');
    Route::get('/ecommerce/order', [HomeController::class, 'order'])->name('ecommerce.order');
});

Route::get('/products/filters', [ProductController::class, 'filters'])->name('ecommerce.product.filters');
Route::get('/products/arrange', [ProductController::class, 'arrange'])->name('ecommerce.product.arrange');
Route::get('/products/search', [ProductController::class, 'search'])->name('ecommerce.product.search');

Route::get('/blog/posts', [BlogController::class, 'index'])->name('ecommerce.blog.index');
Route::get('/blog/posts/show/{id}', [BlogController::class, 'show'])->name('ecommerce.blog.show');

Route::middleware('auth.ecommerce')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('/ecommerce/logout', 'logout')->name('ecommerce.logout');
    });

    Route::controller(FavoriteController::class)->group(function () {
        Route::get('/ecommerce/favorites/{id}', 'favorites')->name('ecommerce.client.favorites');
    });

    Route::controller(HomeController::class)->group(function () {
        Route::get('/ecommerce/profile', 'profile')->name('ecommerce.profile');
    });

    Route::post('favorite', [FavoriteController::class, 'favorite'])->name('ecommerce.client.favorite');

    Route::get('cart/remove/{id}', [CartController::class, 'removeItem'])->name('ecommerce.cart.removeItem');
    Route::post('cart/update/quantity/{id}', [CartController::class, 'updateItemQuantity'])->name('ecommerce.cart.updateItemQuantity');

    Route::get('customer/{customer}', [CustomerController::class, 'show']);
    Route::post('customer/update/{customer}', [CustomerController::class, 'update'])->name('ecommerce.customer.update');
    Route::post('customer/destroy/account/{id}', [CustomerController::class, 'destroy'])->name('ecommerce.customer.destroy');
    Route::post('customer/change/password/{customer}', [AuthController::class, 'changePassword'])->name('ecommerce.customer.change.password');

    Route::post('store/payment/card', [PaymentCardController::class, 'store'])->name('store.payment.card');
    Route::get('destroy/payment/card/{id}', [PaymentCardController::class, 'destroy'])->name('destroy.payment.card');

    Route::post('customer/address', [CustomerAddressController::class, 'store'])->name('customer.address.store');
    Route::post('customer/address/update/{id}', [CustomerAddressController::class, 'update'])->name('customer.address.update');
    Route::get('customer/address/destroy/{id}', [CustomerAddressController::class, 'destroy'])->name('customer.address.destroy');

    
    Route::get('order/show/{id}', [OrderController::class, 'show'])->name('customer.order.show');

    Route::post('ecommerce/coupon/check', [CouponController::class, 'check'])->name('customer.coupon.check');

    Route::group(['prefix' => 'v1'], function () {
        // Client Routes
        Route::group(['prefix' => 'client'], function () {
            Route::get('/OrderTapPayment', [TapPaymentController::class, 'charge'])->name('charge');
            Route::get('/TapCheckout/{id}', [TapPaymentController::class, 'checkout']);
            Route::get('/paymentCallback', [TapPaymentController::class, 'paymentCallback'])->name('paymentCallback');
            Route::get('/paymentPostCallback', [TapPaymentController::class, 'paymentCallback'])->name('paymentPostCallback');
            Route::get('/paymentStatus', [PaymentController::class, 'paymentStatus'])->name('paymentStatus');
        });
    });

    Route::get('tss', function () {
        // Create order on Torod
        $orderData = [
            'name' => 'moanju',
            'email' => 'mmm@kk.cin',
            'phone_number' => '966555555555',
            'item_description' => 'Mobile case covers', // Example item description
            'order_total' => '838',
            'payment' => 'Prepaid', // Assuming the payment method
            'weight' => 20, // Example weight
            'no_of_box' => 1, // Example number of boxes
            'type' => 'address', // Example type
            'locate_address' => 'RFKA3751، 3751 ابي سعيد الخدري، 7393، حي الخليج،, Riyadh 13223',
        ];

        $torodService = new TorodService();
        $torodOrderResponse = $torodService->createOrder($orderData);

    });

});
