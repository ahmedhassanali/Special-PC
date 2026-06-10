<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'en_name' => 'Apple',
            'ar_name' => 'ابل',
            'en_description' => 'A multinational technology company known for its products such as iPhone, iPad, and Mac.',
            'ar_description' => 'شركة تكنولوجيا متعددة الجنسيات معروفة بمنتجاتها مثل الآيفون والآيباد والماك.',
            'image' => 'path/to/brand/apple.jpg',
        ]);

        Brand::create([
            'en_name' => 'Samsung',
            'ar_name' => 'سامسونج',
            'en_description' => 'A South Korean multinational conglomerate known for its electronic products.',
            'ar_description' => 'مجموعة كورية جنوبية متعددة الجنسيات معروفة بمنتجاتها الإلكترونية.',
            'image' => 'path/to/brand/samsung.jpg',
        ]);

        Brand::create([
            'en_name' => 'Nike',
            'ar_name' => 'نايك',
            'en_description' => 'An American multinational corporation known for its sportswear and equipment.',
            'ar_description' => 'شركة أمريكية متعددة الجنسيات معروفة بملابسها الرياضية ومعداتها.',
            'image' => 'path/to/brand/nike.jpg',
        ]);

        Brand::create([
            'en_name' => 'Adidas',
            'ar_name' => 'أديداس',
            'en_description' => 'A multinational corporation known for its sports shoes, clothing, and accessories.',
            'ar_description' => 'شركة متعددة الجنسيات معروفة بأحذيتها الرياضية وملابسها وإكسسواراتها.',
            'image' => 'path/to/brand/adidas.jpg',
        ]);
    }
}
