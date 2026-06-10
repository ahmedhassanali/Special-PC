<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CaptainAuthController;
use App\Http\Controllers\Api\CaptainController;
use App\Http\Controllers\Api\CaptainNotificationController;
use App\Http\Controllers\Api\CaptainOrderController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\CustomerAddressController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('captain/login', [CaptainAuthController::class, 'login']);

Route::group(['middleware' => 'apiKey'], function () {

    Route::post('/send-verification-email', [AuthController::class, 'sendVerificationEmail']);
    Route::post('/check-verification-code', [AuthController::class, 'checkVerificationCode']);
    Route::post('/reset-password-email', [AuthController::class, 'resetPasswordEmail']);
    Route::post('/reset-password-check-code', [AuthController::class, 'resetPasswordCheckCode']);
    Route::post('/new-password', [AuthController::class, 'newPassword']);

    Route::post('captain/reset-password-email', [CaptainAuthController::class, 'resetPasswordEmail']);
    Route::post('captain/reset-password-check-code', [CaptainAuthController::class, 'resetPasswordCheckCode']);
    Route::post('captain/new-password', [CaptainAuthController::class, 'newPassword']);

    Route::get('category',  [CategoryController::class, 'index']);
    Route::get('category/{id}',  [CategoryController::class, 'show']);

    Route::get('subcategory',  [SubCategoryController::class, 'index']);
    Route::get('subcategory/{id}',  [SubCategoryController::class, 'show']);

    Route::get('slider',  [SliderController::class, 'index']);
    Route::get('slider/{id}',  [SliderController::class, 'show']);

    Route::get('brand',  [BrandController::class, 'index']);
    Route::get('brand/{id}',  [BrandController::class, 'show']);

    Route::get('product/{id}',  [ProductController::class, 'show']);
    Route::get('product/related/{id}',  [ProductController::class, 'relatedProducts']);
    Route::get('product/Week/offers',  [ProductController::class, 'productsWithOffersThisWeek']);
    Route::get('product/best/selling',  [ProductController::class, 'bestSellingProducts']);
    Route::post('product/search',  [ProductController::class, 'search']);

    Route::get('city', [CityController::class, 'index']);
    Route::get('city/{id}', [CityController::class, 'show']);

    Route::get('/setting',  [SettingController::class, 'show']);

    Route::middleware('auth:api')->group(function () {

        Route::post('/change-password/{id}', [AuthController::class, 'changePassword']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('customer/{customer}', [CustomerController::class, 'show']);
        Route::post('customer/{customer}', [CustomerController::class, 'update']);
        Route::post('customer/destroy/{customer}', [CustomerController::class, 'destroy']);

        Route::get('customer/address/{customer}', [CustomerAddressController::class, 'index']);
        Route::post('address', [CustomerAddressController::class, 'store']);
        Route::get('address/{id}', [CustomerAddressController::class, 'show']);
        Route::post('address/update/{id}', [CustomerAddressController::class, 'update']);
        Route::post('address/destroy/{id}', [CustomerAddressController::class, 'destroy']);

        Route::post('feedback', [FeedbackController::class, 'feedback']);

        Route::post('favorite', [FavoriteController::class, 'favorite']);
        Route::get('favorites/{customer_id}', [FavoriteController::class, 'favorites']);

        Route::get('notification/{customer_id}',  [NotificationController::class, 'notifications']);
        Route::post('notification/read/{id}/{not}',  [NotificationController::class, 'read']);
        Route::post('notification/delete/{id}/{not}',  [NotificationController::class, 'delete']);

        Route::post('cart/add',  [CartController::class, 'addItem']);
        Route::post('cart/remove/{id}',  [CartController::class, 'removeItem']);
        Route::post('cart/update/quantity/{id}',  [CartController::class, 'updateItemQuantity']);
        Route::get('cart/{customer_id}',  [CartController::class, 'show']);

        Route::post('coupon/check',  [CouponController::class, 'check']);

        Route::post('order/store',  [OrderController::class, 'store']);
        Route::post('order/destroy/{id}', [OrderController::class, 'destroy']);
        Route::get('order/{customer_id}', [OrderController::class, 'index']);
        Route::get('order/show/{id}', [OrderController::class, 'show']);

    });

    Route::middleware('auth:captain_api')->group(function () {

        Route::post('captain/change-password/{id}', [CaptainAuthController::class, 'changePassword']);
        Route::post('captain/logout', [CaptainAuthController::class, 'logout']);

        Route::get('captain/notification/{captain_id}',  [CaptainNotificationController::class, 'notifications']);
        Route::post('captain/notification/read/{id}/{not}',  [CaptainNotificationController::class, 'read']);
        Route::post('/captainnotification/delete/{id}/{not}',  [CaptainNotificationController::class, 'delete']);

        Route::get('captain/order/{captain_id}', [CaptainOrderController::class, 'index']);
        Route::get('captain/order/show/{id}', [CaptainOrderController::class, 'show']);
        Route::post('captain/order/update/status/{id}', [CaptainOrderController::class, 'updateStatus']);

        Route::get('captain/{captain}', [CaptainController::class, 'show']);
        Route::post('captain/{captain}', [CaptainController::class, 'update']);
        Route::post('captain/destroy/{captain}', [CaptainController::class, 'destroy']);

    });

});
