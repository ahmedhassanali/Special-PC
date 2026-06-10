<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['ar_name' => 'الرياض', 'en_name' => 'Riyadh'],
            ['ar_name' => 'جدة', 'en_name' => 'Jeddah'],
            ['ar_name' => 'الدمام', 'en_name' => 'Dammam'],
            ['ar_name' => 'مكة المكرمة', 'en_name' => 'Mecca'],
            ['ar_name' => 'المدينة المنورة', 'en_name' => 'Medina'],
            ['ar_name' => 'بريدة', 'en_name' => 'Buraidah'],
            ['ar_name' => 'تبوك', 'en_name' => 'Tabuk'],
            ['ar_name' => 'الخبر', 'en_name' => 'Al-Khobar'],
            ['ar_name' => 'حائل', 'en_name' => 'Hail'],
            ['ar_name' => 'الطائف', 'en_name' => 'Taif'],
            ['ar_name' => 'القصيم', 'en_name' => 'Al-Qassim'],
            ['ar_name' => 'خميس مشيط', 'en_name' => 'Khamis Mushait'],
            ['ar_name' => 'نجران', 'en_name' => 'Najran'],
            ['ar_name' => 'جازان', 'en_name' => 'Jazan'],
            ['ar_name' => 'الجبيل', 'en_name' => 'Al-Jubail'],
            ['ar_name' => 'الخرج', 'en_name' => 'Al-Kharj'],
            ['ar_name' => 'ينبع', 'en_name' => 'Yanbu'],
            ['ar_name' => 'الحفر', 'en_name' => 'Al-Hofuf'],
            ['ar_name' => 'الزلفي', 'en_name' => 'Al-Zulfi'],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
