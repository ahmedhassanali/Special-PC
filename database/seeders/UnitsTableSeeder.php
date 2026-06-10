<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::create([
            'ar_name' => 'قطعة',
            'en_name' => 'Piece',
            'ar_short_name' => 'قط',
            'en_short_name' => 'pcs',
        ]);

        Unit::create([
            'ar_name' => 'كيلوجرام',
            'en_name' => 'Kilogram',
            'ar_short_name' => 'كجم',
            'en_short_name' => 'kg',
        ]);
    }
}
