<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponsTableSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::create([
            'code' => 'WELCOME20',
            'uses' => 0,
            'type' => Coupon::PERSENTAGE,
            'end_at' => now()->addMonths(1), // Expires in 1 month
            'amount' => 20, // 20% discount
            'max' => 100, // Maximum usage limit
            'status' => Coupon::ACTIVE,
            'notes' => 'Welcome discount for new users',
            'for' => Coupon::FIRST_TIME_USERS,
        ]);

        Coupon::create([
            'code' => 'SALE50',
            'uses' => 0,
            'type' => Coupon::VALUE,
            'end_at' => now()->addDays(7), // Expires in 7 days
            'amount' => 50, // $50 discount
            'max' => Coupon::UNLIMITED_USERS, // Unlimited usage
            'status' => Coupon::ACTIVE,
            'notes' => 'Special sale discount',
            'for' => Coupon::ALL_USERS,
        ]);
    }
}
