<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            // Areas in Riyadh (City ID: 1)
            ['ar_name' => 'الرياضية', 'en_name' => 'Sportive', 'city_id' => 1, 'delivery_fees' => '50'],
            ['ar_name' => 'النزهة', 'en_name' => 'Al-Nazhah', 'city_id' => 1, 'delivery_fees' => '50'],
            ['ar_name' => 'العليا', 'en_name' => 'Al-Olaya', 'city_id' => 1, 'delivery_fees' => '50'],
            ['ar_name' => 'المروج', 'en_name' => 'Al-Murooj', 'city_id' => 1, 'delivery_fees' => '50'],
            ['ar_name' => 'العزيزية', 'en_name' => 'Al-Azizia', 'city_id' => 1, 'delivery_fees' => '50'],

            // Areas in Jeddah (City ID: 2)
            ['ar_name' => 'البلد', 'en_name' => 'Al-Balad', 'city_id' => 2, 'delivery_fees' => '40'],
            ['ar_name' => 'السلامة', 'en_name' => 'Al-Salamah', 'city_id' => 2, 'delivery_fees' => '40'],
            ['ar_name' => 'الحمراء', 'en_name' => 'Al-Hamra', 'city_id' => 2, 'delivery_fees' => '40'],
            ['ar_name' => 'الروضة', 'en_name' => 'Al-Rawdah', 'city_id' => 2, 'delivery_fees' => '40'],
            ['ar_name' => 'الفيصلية', 'en_name' => 'Al-Faisaliyah', 'city_id' => 2, 'delivery_fees' => '40'],

            // Areas in Dammam (City ID: 3)
            ['ar_name' => 'الشاطئ', 'en_name' => 'Ash-Shati', 'city_id' => 3, 'delivery_fees' => '30'],
            ['ar_name' => 'الفيصلية', 'en_name' => 'Al-Faisaliyah', 'city_id' => 3, 'delivery_fees' => '30'],
            ['ar_name' => 'المزروعية', 'en_name' => 'Al-Mazrooia', 'city_id' => 3, 'delivery_fees' => '30'],
            ['ar_name' => 'الخبر الجنوبية', 'en_name' => 'Al-Khobar Al-Janubiyah', 'city_id' => 3, 'delivery_fees' => '30'],
            ['ar_name' => 'الدانة', 'en_name' => 'Al-Danah', 'city_id' => 3, 'delivery_fees' => '30'],

            // Areas in Makkah (Mecca) (City ID: 4)
            ['ar_name' => 'العزيزية', 'en_name' => 'Al-Aziziyyah', 'city_id' => 4, 'delivery_fees' => '60'],
            ['ar_name' => 'الشوقية', 'en_name' => 'Al-Shawqiyyah', 'city_id' => 4, 'delivery_fees' => '60'],
            ['ar_name' => 'الحرة', 'en_name' => 'Al-Hurrah', 'city_id' => 4, 'delivery_fees' => '60'],
            ['ar_name' => 'الفيحاء', 'en_name' => 'Al-Faifa', 'city_id' => 4, 'delivery_fees' => '60'],
            ['ar_name' => 'الكعبة', 'en_name' => 'Al-Kaaba', 'city_id' => 4, 'delivery_fees' => '60'],

            // Areas in Al Madinah (Medina) (City ID: 5)
            ['ar_name' => 'المروج', 'en_name' => 'Al-Murooj', 'city_id' => 5, 'delivery_fees' => '55'],
            ['ar_name' => 'البلوط', 'en_name' => 'Al-Baloot', 'city_id' => 5, 'delivery_fees' => '55'],
            ['ar_name' => 'الراشد', 'en_name' => 'Al-Rashed', 'city_id' => 5, 'delivery_fees' => '55'],
            ['ar_name' => 'الفيصل', 'en_name' => 'Al-Faisal', 'city_id' => 5, 'delivery_fees' => '55'],
            ['ar_name' => 'الصفا', 'en_name' => 'Al-Safa', 'city_id' => 5, 'delivery_fees' => '55'],
            

        ];

        foreach ($areas as $area) {
            Area::create($area);
        }
    }
}
