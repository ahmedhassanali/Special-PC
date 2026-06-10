<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'role', 'permission',
    ];

    protected $routes = [
        '1' => [
            'admin.index',
        ],
        '2' => [
            'admin.manager.index',
            'admin.manager.updateOrCreate',
            'admin.manager.create',
            'admin.manager.edit',
            'admin.manager.save',
            'admin.manager.approve',
            'admin.manager.desactivate',
            'admin.manager.role',
            'admin.manager.delete',
            'admin.manager.editRole',
            'admin.manager.createRole',
            'admin.manager.roleUpdateOrCreate',
            'admin.manager.deleteRole',
            'admin.manager.user_activity',
        ],
        '3' => [
            'admin.setting.index',
            'admin.setting.update',
        ],
        '4' => [
            'admin.profile.index',
            'admin.profile.update',
        ],
        '5' => [
            'admin.category.index',
            'admin.category.create',
            'admin.category.edit',
            'admin.category.update',
            'admin.category.store',
            'admin.category.save',
            'admin.category.approve',
            'admin.category.desactivate',
            'admin.category.delete',
        ],
        '6' => [
            'admin.subCategory.index',
            'admin.subCategory.create',
            'admin.subCategory.edit',
            'admin.subCategory.save',
            'admin.subCategory.update',
            'admin.subCategory.store',
            'admin.subCategory.approve',
            'admin.subCategory.desactivate',
            'admin.subCategory.delete',
            'admin.subCategory.getAll',
        ],
        '7' => [
            'admin.product.index',
            'admin.product.create',
            'admin.product.edit',
            'admin.product.save',
            'admin.product.update',
            'admin.product.store',
            'admin.product.approve',
            'admin.product.desactivate',
            'admin.product.delete',
            'admin.product.deleteImage',
        ],
        '8' => [
            'admin.order.index',
            'admin.order.create',
            'admin.order.edit',
            'admin.order.save',
            'admin.order.update',
            'admin.order.store',
            'admin.order.approve',
            'admin.order.desactivate',
            'admin.order.delete',
            'admin.order.show',
            'admin.order.delivery',
            'admin.order.update.delivery',
            'admin.captain.orders',
        ],
        '9' => [
            'admin.brand.index',
            'admin.brand.create',
            'admin.brand.edit',
            'admin.brand.save',
            'admin.brand.update',
            'admin.brand.store',
            'admin.brand.approve',
            'admin.brand.desactivate',
            'admin.brand.delete',
        ],
        '10' => [
            'admin.unit.index',
            'admin.unit.create',
            'admin.unit.edit',
            'admin.unit.save',
            'admin.unit.update',
            'admin.unit.store',
            'admin.unit.approve',
            'admin.unit.desactivate',
            'admin.unit.delete',

            'admin.color.index',
            'admin.color.create',
            'admin.color.edit',
            'admin.color.save',
            'admin.color.update',
            'admin.color.store',
            'admin.color.approve',
            'admin.color.desactivate',
            'admin.color.delete',
        ],
        '11' => [
            'admin.offer.index',
            'admin.offer.create',
            'admin.offer.edit',
            'admin.offer.save',
            'admin.offer.update',
            'admin.offer.store',
            'admin.offer.approve',
            'admin.offer.desactivate',
            'admin.offer.delete',
        ],
        '12' => [
            'admin.slider.index',
            'admin.slider.create',
            'admin.slider.edit',
            'admin.slider.save',
            'admin.slider.update',
            'admin.slider.store',
            'admin.slider.approve',
            'admin.slider.desactivate',
            'admin.slider.delete',
        ],
        '13' => [
            'admin.customer.index',
            'admin.customer.create',
            'admin.customer.edit',
            'admin.customer.save',
            'admin.customer.update',
            'admin.customer.store',
            'admin.customer.approve',
            'admin.customer.show',
            'admin.customer.delete',
            'admin.customer.changeStatus',
            'admin.customer.orders',
        ],
        '14' => [
            'admin.report.index',
            'admin.report.create',
            'admin.report.edit',
            'admin.report.save',
            'admin.report.update',
            'admin.report.store',
            'admin.report.approve',
            'admin.report.show',
            'admin.report.delete',
            'admin.report.changeStatus',
            'admin.report.orders',
            'admin.report.search',
        ],
        '15' => [
            'admin.feedback.index',
            'admin.feedback.create',
            'admin.feedback.edit',
            'admin.feedback.save',
            'admin.feedback.update',
            'admin.feedback.store',
            'admin.feedback.approve',
            'admin.feedback.show',
            'admin.feedback.delete',
            'admin.feedback.changeStatus',
            'admin.feedback.orders',
            'admin.feedback.search',
        ],
        '16' => [
            'admin.payment.index',
            'admin.payment.create',
            'admin.payment.edit',
            'admin.payment.save',
            'admin.payment.update',
            'admin.payment.store',
            'admin.payment.approve',
            'admin.payment.show',
            'admin.payment.delete',
            'admin.payment.changeStatus',
            'admin.payment.orders',
            'admin.payment.search',
        ],
        '17' => [
            'admin.coupon.index',
            'admin.coupon.create',
            'admin.coupon.edit',
            'admin.coupon.save',
            'admin.coupon.update',
            'admin.coupon.store',
            'admin.coupon.approve',
            'admin.coupon.show',
            'admin.coupon.delete',
            'admin.coupon.changeStatus',
            'admin.coupon.orders',
            'admin.coupon.search',
        ],
        '18' => [
            'admin.area.index',
            'admin.area.create',
            'admin.area.edit',
            'admin.area.save',
            'admin.area.update',
            'admin.area.store',
            'admin.area.show',
            'admin.area.delete',
        ],
        '19' => [
            'admin.city.index',
            'admin.city.create',
            'admin.city.edit',
            'admin.city.save',
            'admin.city.update',
            'admin.city.store',
            'admin.city.show',
            'admin.city.delete',
        ],
        '20' => [
            'admin.captain.index',
            'admin.captain.create',
            'admin.captain.edit',
            'admin.captain.save',
            'admin.captain.update',
            'admin.captain.store',
            'admin.captain.show',
            'admin.captain.delete',
            'admin.captain.changeStatus',
        ],

        '21' => [
            'admin.translation.showEditLang',
            'admin.translation.loadLangData',
            'admin.translation.saveLangFile',
            'admin.translation.loadFileData',
            'admin.translation.addTranslation',
        ],

        '22' => [
            'admin.blog.index',
            'admin.blog.create',
            'admin.blog.edit',
            'admin.blog.save',
            'admin.blog.update',
            'admin.blog.store',
        ],

        '23' => [
            'admin.cart.index',
        ],

        '24' => [
            'admin.marketers.index',
            'admin.marketers.update',
            'admin.marketers.store',
            'admin.marketers.delete',
            'admin.marketers.create',
            'admin.marketers.edit',
            'admin.marketers.show',
        ],

    ];

    protected $navbar = [

        '1' => [
            'title' => 'Dashboard',
            'ar_title' => 'الرئيسية',
            'route' => 'admin.index',
            'icon' => 'fa fa-tachometer-alt me-2',
        ],

        '2' => [
            'title' => 'Daily uses',
            'ar_title' => 'المعاملات اليوميه',
            'route' => 'admin.order.index',
            'icon' => 'bi bi-house-fill me-2',
            'items' => [
                [
                    'title' => 'Orders',
                    'ar_title' => 'الطلبات',
                    'route' => 'admin.order.index',
                    'icon' => 'fa fa-th-list me-2',
                ],
                [
                    'title' => 'Profile',
                    'ar_title' => 'الملف الشخصي',
                    'route' => 'admin.profile.index',
                    'icon' => 'fa fa-user me-2',
                ],
                [
                    'title' => 'Users Cart',
                    'ar_title' => 'عربات المستخدمين',
                    'route' => 'admin.cart.index',
                    'icon' => 'fa fa-shopping-cart me-2',
                ],
            ],
        ],

        '3' => [
            'title' => 'Ecommerce Mangement',
            'ar_title' => 'إدارة المتجر',
            'route' => 'admin.product.index',
            'icon' => 'bi bi-bag-fill me-2',
            'items' => [
                [
                    'title' => 'Products',
                    'ar_title' => 'المنتجات',
                    'route' => 'admin.product.index',
                    'icon' => 'fa fa-cube me-2',
                ],
                [
                    'title' => 'Category',
                    'ar_title' => 'التصنيفات',
                    'route' => 'admin.category.index',
                    'icon' => 'fa fa-cubes me-2',
                ],
                [
                    'title' => 'Units',
                    'ar_title' => 'الوحدات',
                    'route' => 'admin.unit.index',
                    'icon' => 'fa fa-star me-2',
                ],
                [
                    'title' => 'Colors',
                    'ar_title' => 'الألوان',
                    'route' => 'admin.color.index',
                    'icon' => 'fa fa-paint-roller me-2',
                ],
                [
                    'title' => 'Brands',
                    'ar_title' => 'الماركات',
                    'route' => 'admin.brand.index',
                    'icon' => 'fa fa-flag me-2',
                ],
                [
                    'title' => 'Offers',
                    'ar_title' => 'العروض',
                    'route' => 'admin.offer.index',
                    'icon' => 'fa fa-cog me-2',
                ],
                [
                    'title' => 'Sliders',
                    'ar_title' => 'السلايدر',
                    'route' => 'admin.slider.index',
                    'icon' => 'fa fa-object-group me-2',
                ],
            ],
        ],

        '4' => [
            'title' => 'Clients & Users',
            'ar_title' => 'العملاء و المستخدمين',
            'route' => 'admin.customer.index',
            'icon' => 'bi bi-people-fill me-2',
            'items' => [
                [
                    'title' => 'Customers',
                    'ar_title' => 'العملاء',
                    'route' => 'admin.customer.index',
                    'icon' => 'fa fa-user me-2',
                ],
                [
                    'title' => 'Marketers',
                    'ar_title' => 'المسوقين بالعمولة',
                    'route' => 'admin.marketers.index',
                    'icon' => 'fa fa-coins me-2',
                ],
                [
                    'title' => 'Captains',
                    'ar_title' => 'الكابتن',
                    'route' => 'admin.captain.index',
                    'icon' => 'fa fa-image me-2',
                ],
                [
                    'title' => 'Users',
                    'ar_title' => 'المستخدمين',
                    'route' => 'admin.manager.index',
                    'icon' => 'fa fa-users me-2',
                ],
                [
                    'title' => 'User Manager',
                    'ar_title' => 'مدير المستخدم',
                    'route' => 'admin.manager.index',
                    'icon' => 'fa fa-user me-2',
                ],
                [
                    'title' => 'User Roles',
                    'ar_title' => 'وظيفة المستخدم',
                    'route' => 'admin.manager.role',
                    'icon' => 'fa fa-gears me-2',
                ],
                [
                    'title' => 'User Activity',
                    'ar_title' => 'نشاط المستخدم',
                    'route' => 'admin.manager.user_activity',
                    'icon' => 'fa fa-users me-2',
                ],
            ],
        ],

        '5' => [
            'title' => 'Settings',
            'ar_title' => 'الاعدادات',
            'route' => 'admin.setting.index',
            'icon' => 'bi bi-gear-fill me-2',
            'items' => [
                [
                    'title' => 'Settings',
                    'ar_title' => 'الاعدادات',
                    'route' => 'admin.setting.index',
                    'icon' => 'fa fa-users me-2',
                ],
                [
                    'title' => 'Translations',
                    'ar_title' => 'الترجمات',
                    'route' => 'admin.translation.showEditLang',
                    'icon' => 'fa fa-user me-2',
                ],
            ],
        ],

        '6' => [
            'title' => 'General Mangement',
            'ar_title' => 'الادارة العامه',
            'route' => 'admin.report.index',
            'icon' => 'bi bi-person-fill me-2',
            'items' => [
                [
                    'title' => 'Reports',
                    'ar_title' => 'التقارير',
                    'route' => 'admin.report.index',
                    'icon' => 'fa fa-search me-2',
                ],

                [
                    'title' => 'Payments',
                    'ar_title' => 'المدفوعات',
                    'route' => 'admin.payment.index',
                    'icon' => 'fa fa-credit-card me-2',
                ],

                [
                    'title' => 'Blog',
                    'ar_title' => 'المدونة',
                    'route' => 'admin.blog.index',
                    'icon' => 'fa fa-blog me-2',
                ],

                [
                    'title' => 'Feedbacks',
                    'ar_title' => 'التعليقات',
                    'route' => 'admin.feedback.index',
                    'icon' => 'fa fa-bullhorn me-2',
                ],

                [
                    'title' => 'Coupons',
                    'ar_title' => 'الكوبونات',
                    'route' => 'admin.coupon.index',
                    'icon' => 'fa fa-image me-2',
                ],
                [
                    'title' => 'Cities',
                    'ar_title' => 'المدن',
                    'route' => 'admin.city.index',
                    'icon' => 'fa fa-image me-2',
                ],
            ]
        ]
    ];

    public function hasPermissionTo($permission)
    {

        $permissions = explode(',', $this->permission);

        return in_array($permission, $permissions);
    }

    public function routePermission($routeRquest)
    {

        // check if the user has th e permission to the route
        foreach ($this->routes as $key => $value) {
            if (in_array($routeRquest, $value)) {
                if ($this->hasPermissionTo($key)) {
                    return true;
                }
            }
        }

    }

    public function sidenav_list()
    {
        $allowed_routes = [];
        foreach ($this->navbar as $nav) {
            if ($this->routePermission($nav['route'])) {
                $allowed_routes[] = $nav;
            }
        }

        return $allowed_routes;
    }

}
