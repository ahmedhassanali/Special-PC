<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminController,
    AreaController,
    BrandController,
    CaptainController,
    CategoryController,
    CityController,
    CouponController,
    CustomerController,
    OfferController,
    FeedbackController,
    ManagerController,
    OrderController,
    PaymentController,
    ProductController,
    SettingController,
    ProfileController,
    ReportController,
    SubCategoryController,
    UnitController,
    ColorController,
    BlogController,
    SliderController,
    CartController,
    TranslationController,
    MarketerController,
    MaintenanceController,
    MaintenanceServiceController
};

use App\Http\Controllers\HomeController as controllerHomeController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Auth;

Route::patch('/fcm-token', [controllerHomeController::class, 'updateToken'])->name('fcmToken');

Route::post('/send-notification', [controllerHomeController::class, 'notification'])->name('notification');

// notification routes Group
Route::group(['prefix' => 'notification'], function () {
    // notification routes
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/index', 'index')->name('admin.notification.index');
        Route::get('/markAsRead', 'markAsRead')->name('admin.notification.markAsRead');
        Route::get('/clear', 'clear')->name('admin.notification.clear');

        Route::get('notification/{id}', 'notification')->name('admin.notification.notification');
        Route::get('/unread', 'unread')->name('admin.notification.unread');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth', 'user.log']], function () {
    // dashboard page
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');

    // Maintenance / Repair Orders
    Route::group(['prefix' => 'maintenance'], function () {
        Route::get('/', [MaintenanceController::class, 'index'])->name('admin.maintenance.index');
        Route::patch('/orders/{order}', [MaintenanceController::class, 'updateOrder'])->name('admin.maintenance.orders.update');
        Route::post('/orders/{order}/extras', [MaintenanceController::class, 'addExtra'])->name('admin.maintenance.orders.extras.store');
        Route::post('/orders/{order}/images', [MaintenanceController::class, 'uploadImages'])->name('admin.maintenance.orders.images.store');
        Route::delete('/orders/{order}/images/{image}', [MaintenanceController::class, 'deleteImage'])->name('admin.maintenance.orders.images.delete');

        Route::controller(MaintenanceServiceController::class)->prefix('services')->group(function () {
            Route::get('/', 'index')->name('admin.maintenance.services.index');
            Route::post('/', 'store')->name('admin.maintenance.services.store');
            Route::patch('/{service}', 'update')->name('admin.maintenance.services.update');
        });
    });


    // Setting Route Group
    Route::group(['prefix' => 'setting'], function () {
        // setting routes
        Route::controller(SettingController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.setting.index');
            Route::post('update', 'update')->name('admin.setting.update');
        });
    });

    Route::group(['prefix' => 'profile'], function () {
        // profile routes
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.profile.index');
            Route::post('update', 'update')->name('admin.profile.update');
        });
    });

    Route::group(['prefix' => 'subCategory'], function () {
        // profile routes

        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('/index/{id}', 'index')->name('admin.subCategory.index');
            Route::post('update/{id}', 'update')->name('admin.subCategory.update');
            Route::post('store', 'store')->name('admin.subCategory.store');
            Route::post('delete/{id}', 'delete')->name('admin.subCategory.delete');
            Route::get('/create/{id}', 'create')->name('admin.subCategory.create');
            Route::get('/edit/{id}', 'edit')->name('admin.subCategory.edit');
            Route::get('/getAll/{id}', 'getAll')->name('admin.subCategory.getAll');
        });
    });

    Route::group(['prefix' => 'category'], function () {
        // profile routes
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.category.index');
            Route::post('update/{category}', 'update')->name('admin.category.update');
            Route::post('store', 'store')->name('admin.category.store');
            Route::post('delete/{id}', 'delete')->name('admin.category.delete');
            Route::get('/create', 'create')->name('admin.category.create');
            Route::get('/edit/{id}', 'edit')->name('admin.category.edit');
        });
    });

    Route::group(['prefix' => 'city'], function () {
        // profile routes
        Route::controller(CityController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.city.index');
            Route::post('update/{city}', 'update')->name('admin.city.update');
            Route::post('store', 'store')->name('admin.city.store');
            Route::post('delete/{id}', 'delete')->name('admin.city.delete');
            Route::get('/create', 'create')->name('admin.city.create');
            Route::get('/edit/{id}', 'edit')->name('admin.city.edit');
        });
    });

    Route::group(['prefix' => 'area'], function () {
        // profile routes
        Route::controller(AreaController::class)->group(function () {
            Route::get('/index/{id}', 'index')->name('admin.area.index');
            Route::post('update/{area}', 'update')->name('admin.area.update');
            Route::post('store', 'store')->name('admin.area.store');
            Route::post('delete/{id}', 'delete')->name('admin.area.delete');
            Route::get('/create/{id}', 'create')->name('admin.area.create');
            Route::get('/edit/{id}', 'edit')->name('admin.area.edit');
        });
    });

    Route::group(['prefix' => 'cart'], function () {
          // profile routes
          Route::controller(CartController::class)->group(function () {
             Route::get('carts',  'index')->name('admin.cart.index');
          });
    });


    Route::group(['prefix' => 'product'], function () {
        // profile routes
        Route::controller(ProductController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.product.index');
            Route::post('update/{product}', 'update')->name('admin.product.update');
            Route::post('store', 'store')->name('admin.product.store');
            Route::post('delete/{id}', 'delete')->name('admin.product.delete');
            Route::get('/create', 'create')->name('admin.product.create');
            Route::get('/edit/{id}', 'edit')->name('admin.product.edit');
            Route::post('/deleteImage/{id}', 'deleteImage')->name('admin.product.deleteImage');
        });
    });

    Route::group(['prefix' => 'coupon'], function () {
        // profile routes
        Route::controller(CouponController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.coupon.index');
            Route::post('update/{coupon}', 'update')->name('admin.coupon.update');
            Route::post('store', 'store')->name('admin.coupon.store');
            Route::post('delete/{id}', 'delete')->name('admin.coupon.delete');
            Route::get('/create', 'create')->name('admin.coupon.create');
            Route::get('/edit/{id}', 'edit')->name('admin.coupon.edit');
            Route::post('/deleteImage/{id}', 'deleteImage')->name('admin.coupon.deleteImage');
            Route::post('/changeStatus/{id}',  'changeStatus')->name('admin.coupon.changeStatus');
        });
    });

    Route::group(['prefix' => 'unit'], function () {
        // profile routes
        Route::controller(UnitController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.unit.index');
            Route::post('update/{unit}', 'update')->name('admin.unit.update');
            Route::post('store', 'store')->name('admin.unit.store');
            Route::post('delete/{id}', 'delete')->name('admin.unit.delete');
            Route::get('/create', 'create')->name('admin.unit.create');
            Route::get('/edit/{id}', 'edit')->name('admin.unit.edit');
        });
    });


    Route::group(['prefix' => 'color'], function () {
        Route::controller(ColorController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.color.index');
            Route::post('update/{color}', 'update')->name('admin.color.update');
            Route::post('store', 'store')->name('admin.color.store');
            Route::post('delete/{id}', 'delete')->name('admin.color.delete');
            Route::get('/create', 'create')->name('admin.color.create');
            Route::get('/edit/{id}', 'edit')->name('admin.color.edit');
        });
    });


    Route::prefix('blog')->group(function () {
        Route::controller(BlogController::class)->group(function () {

        Route::get('/', 'index')->name('admin.blog.index');
        Route::get('/create', 'create')->name('admin.blog.create');
        Route::post('/store', 'store')->name('admin.blog.store');
        Route::get('/edit/{id}', 'edit')->name('admin.blog.edit');
        Route::put('/update/{id}', 'update')->name('admin.blog.update');
        Route::delete('/delete/{id}', 'delete')->name('admin.blog.delete');
    });

    });

    Route::group(['prefix' => 'brand'], function () {
        // profile routes
        Route::controller(BrandController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.brand.index');
            Route::post('update/{brand}', 'update')->name('admin.brand.update');
            Route::post('store', 'store')->name('admin.brand.store');
            Route::post('delete/{id}', 'delete')->name('admin.brand.delete');
            Route::get('/create', 'create')->name('admin.brand.create');
            Route::get('/edit/{id}', 'edit')->name('admin.brand.edit');
        });
    });

    Route::group(['prefix' => 'customer'], function () {
        // profile routes
        Route::controller(CustomerController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.customer.index');
            Route::post('update/{customer}', 'update')->name('admin.customer.update');
            Route::post('store', 'store')->name('admin.customer.store');
            Route::post('delete/{id}', 'delete')->name('admin.customer.delete');
            Route::get('/create', 'create')->name('admin.customer.create');
            Route::get('/edit/{id}', 'edit')->name('admin.customer.edit');
            Route::get('/show/{id}', 'show')->name('admin.customer.show');
            Route::post('/changeStatus/{id}',  'changeStatus')->name('admin.customer.changeStatus');
            Route::get('/customerOrders/{id}',  'customerOrders')->name('admin.customer.orders');
        });
    });


    Route::group(['prefix' => 'marketers'], function () {
        Route::controller(MarketerController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.marketers.index');
            Route::get('/create', 'create')->name('admin.marketers.create');
            Route::post('/store', 'store')->name('admin.marketers.store');
            Route::get('/edit/{id}', 'edit')->name('admin.marketers.edit');
            Route::get('/show/{id}', 'show')->name('admin.marketers.show');
            Route::post('/update/{id}', 'update')->name('admin.marketers.update');
            Route::post('/delete/{id}', 'delete')->name('admin.marketers.delete');
        });
    });
    

    Route::group(['prefix' => 'captain'], function () {
        // profile routes
        Route::controller(CaptainController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.captain.index');
            Route::post('update/{captain}', 'update')->name('admin.captain.update');
            Route::post('store', 'store')->name('admin.captain.store');
            Route::post('delete/{id}', 'delete')->name('admin.captain.delete');
            Route::get('/create', 'create')->name('admin.captain.create');
            Route::get('/edit/{id}', 'edit')->name('admin.captain.edit');
            Route::get('/show/{id}', 'show')->name('admin.captain.show');
            Route::post('/changeStatus/{id}',  'changeStatus')->name('admin.captain.changeStatus');
            Route::get('/orders/{id}',  'orders')->name('admin.captain.orders');
        });
    });

    Route::group(['prefix' => 'order'], function () {
        // profile routes
        Route::controller(OrderController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.order.index');
            Route::post('update/{order}', 'update')->name('admin.order.update');
            Route::post('store', 'store')->name('admin.order.store');
            Route::post('delete/{id}', 'delete')->name('admin.order.delete');
            Route::get('/create', 'create')->name('admin.order.create');
            Route::get('/edit/{id}', 'edit')->name('admin.order.edit');
            Route::get('/show/{id}', 'show')->name('admin.order.show');
            Route::post('/changeStatus/{id}',  'changeStatus')->name('admin.order.changeStatus');
            Route::get('/add/delivery/{id}', 'delivery')->name('admin.order.delivery');
            Route::post('/add/delivery/{id}', 'updateDelivery')->name('admin.order.update.delivery');
        });
    });

    Route::group(['prefix' => 'report'], function () {
        // profile routes
        Route::controller(ReportController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.report.index');
            Route::post('update/{order}', 'update')->name('admin.report.update');
            Route::get('/edit/{id}', 'edit')->name('admin.report.edit');
            Route::get('/show/{id}', 'show')->name('admin.report.show');
            Route::post('/search', 'index')->name('admin.report.search');
        });
    });

    Route::group(['prefix' => 'feedback'], function () {
        // profile routes
        Route::controller(FeedbackController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.feedback.index');
            Route::post('update/{order}', 'update')->name('admin.feedback.update');
            Route::get('/edit/{id}', 'edit')->name('admin.feedback.edit');
            Route::get('/show/{id}', 'show')->name('admin.feedback.show');
            Route::post('/search', 'index')->name('admin.feedback.search');
        });
    });

    Route::group(['prefix' => 'payment'], function () {
        // profile routes
        Route::controller(PaymentController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.payment.index');
            Route::post('update/{order}', 'update')->name('admin.payment.update');
            Route::get('/edit/{id}', 'edit')->name('admin.payment.edit');
            Route::get('/show/{id}', 'show')->name('admin.payment.show');
            Route::post('/search', 'index')->name('admin.payment.search');
        });
    });

    Route::group(['prefix' => 'offer'], function () {
        // profile routes
        Route::controller(OfferController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.offer.index');
            Route::post('update/{offer}', 'update')->name('admin.offer.update');
            Route::post('store', 'store')->name('admin.offer.store');
            Route::post('delete/{id}', 'delete')->name('admin.offer.delete');
            Route::get('/create', 'create')->name('admin.offer.create');
            Route::get('/edit/{id}', 'edit')->name('admin.offer.edit');
        });
    });

    Route::group(['prefix' => 'slider'], function () {
        // profile routes
        Route::controller(SliderController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.slider.index');
            Route::post('update/{slider}', 'update')->name('admin.slider.update');
            Route::post('store', 'store')->name('admin.slider.store');
            Route::post('delete/{id}', 'delete')->name('admin.slider.delete');
            Route::get('/create', 'create')->name('admin.slider.create');
            Route::get('/edit/{id}', 'edit')->name('admin.slider.edit');
        });
    });

    Route::group(['prefix' => 'manager'], function () {
        // Manager routes
        Route::controller(ManagerController::class)->group(function () {
            Route::get('/index', 'index')->name('admin.manager.index');
            Route::post('updateOrCreate/{id}', 'updateOrCreate')->name('admin.manager.updateOrCreate');
            Route::post('store/{id}', 'store')->name('admin.manager.store');
            Route::post('update/{id}', 'update')->name('admin.manager.update');
            Route::get('/create', 'create')->name('admin.manager.create');
            Route::get('/edit/{id}', 'edit')->name('admin.manager.edit');
            Route::post('/save/{id}', 'save')->name('admin.manager.save');
            Route::post('approve/{id}', 'approve')->name('admin.manager.approve');
            Route::post('desactivate/{id}', 'desactivate')->name('admin.manager.desactivate');
            Route::get('/roles', 'roles')->name('admin.manager.role');
            Route::post('delete/{id}', 'delete')->name('admin.manager.delete');
            Route::get('/editRole/{id}', 'roleEdit')->name('admin.manager.editRole');
            Route::get('/createRole', 'roleCreate')->name('admin.manager.createRole');
            Route::post('roleUpdateOrCreate/{id}', 'roleUpdateOrCreate')->name('admin.manager.roleUpdateOrCreate');
            Route::get('/deleteRole/{id}', 'roleDelete')->name('admin.manager.deleteRole');
            Route::get('/user_activity', 'user_activity')->name('admin.manager.user_activity');
        });
    });


    Route::group(['prefix' => '/translation'], function () {
        Route::controller(TranslationController::class)->group(function () {

            Route::get('/edit/lang',  'showEditLang')->name('admin.translation.showEditLang');
            Route::post('/load-lang-data','loadLangData')->name('admin.translation.loadLangData');
            Route::post('/save/lang/file', 'saveLangFile')->name('admin.translation.saveLangFile');
            Route::get('/load-file-data', 'loadFileData')->name('admin.translation.loadFileData');
            Route::post('/add/translation', 'addTranslation')->name('admin.translation.addTranslation');

        });
    });

});
