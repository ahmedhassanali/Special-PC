<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('123456789'),
            'image' => null,
            'status' => Customer::ACTIVE,
            'phone' => '123456789',
            'gender' => Customer::MALE,
            'age' => 30,
            'fcm_token' => null,
            'wallet' => 100.00,
        ]);

        Customer::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('123456789'),
            'image' => null,
            'status' => Customer::ACTIVE,
            'phone' => '987654321',
            'gender' => Customer::FEMALE,
            'age' => 25,
            'fcm_token' => null,
            'wallet' => 150.00,
        ]);
    }
}
