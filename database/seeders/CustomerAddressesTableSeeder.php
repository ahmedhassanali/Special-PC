<?php

namespace Database\Seeders;

use App\Models\CustomerAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerAddress::create([
            'customer_id' => 1,
            'title' => 'Home',
            'default' => 1,
            'address' => '123 Main Street',
            'city_id' => 1,
            'area_id' => 2,
        ]);

        CustomerAddress::create([
            'customer_id' => 1,
            'title' => 'Work',
            'default' => 0,
            'address' => '456 Business Avenue',
            'city_id' => 1,
            'area_id' => 1,
        ]);
    }
}
