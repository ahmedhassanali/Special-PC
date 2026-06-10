<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offer::create([
            'en_name' => 'Offer 1',
            'ar_name' => 'العرض 1',
            'type' => Offer::PERSENTAGE,
            'amount' => 10, // 10% discount
            'start_date' => now(),
            'end_date' => now()->addDays(7), // Offer valid for 7 days
            'ar_description' => 'وصف العرض 1',
            'en_description' => 'Description of Offer 1',
        ]);

        Offer::create([
            'en_name' => 'Offer 2',
            'ar_name' => 'العرض 2',
            'type' => Offer::VALUE,
            'amount' => 20, // $20 discount
            'start_date' => now(),
            'end_date' => now()->addDays(10), // Offer valid for 10 days
            'ar_description' => 'وصف العرض 2',
            'en_description' => 'Description of Offer 2',
        ]);
    }
}
