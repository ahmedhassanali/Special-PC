<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategoriesTableSeeder::class,
            SubCategoriesTableSeeder::class,
            CouponsTableSeeder::class,
            BrandsTableSeeder::class,
            CustomersTableSeeder::class,
            CitiesTableSeeder::class,
            AreasTableSeeder::class,
            CustomerAddressesTableSeeder::class,
            UnitsTableSeeder::class,
            ProductsTableSeeder::class,
            OffersTableSeeder::class,
        ]);
    }
}
