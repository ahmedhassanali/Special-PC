<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::create([
            'image' => 'path/to/subcategory1/image.jpg',
            'en_title' => 'Laptops',
            'ar_title' => 'أجهزة الكمبيوتر المحمولة',
            'en_description' => 'A wide range of laptops for various purposes.',
            'ar_description' => 'مجموعة متنوعة من أجهزة الكمبيوتر المحمولة لأغراض مختلفة.',
            'category_id' => 1, // Assuming category_id 1 corresponds to Computers category
        ]);

        SubCategory::create([
            'image' => 'path/to/subcategory2/image.jpg',
            'en_title' => 'Smartphones',
            'ar_title' => 'الهواتف الذكية',
            'en_description' => 'The latest smartphones with advanced features.',
            'ar_description' => 'أحدث الهواتف الذكية بميزات متقدمة.',
            'category_id' => 2, // Assuming category_id 2 corresponds to Mobile Phones category
        ]);

        SubCategory::create([
            'image' => 'path/to/subcategory3/image.jpg',
            'en_title' => 'Headphones',
            'ar_title' => 'سماعات الرأس',
            'en_description' => 'High-quality headphones for immersive audio experience.',
            'ar_description' => 'سماعات رأس عالية الجودة لتجربة صوتية غامرة.',
            'category_id' => 3, // Assuming category_id 3 corresponds to Audio category
        ]);

        SubCategory::create([
            'image' => 'path/to/subcategory4/image.jpg',
            'en_title' => 'Fitness Trackers',
            'ar_title' => 'أجهزة تتبع اللياقة البدنية',
            'en_description' => 'Track your fitness goals with advanced fitness trackers.',
            'ar_description' => 'تتبع أهداف لياقتك البدنية مع أجهزة تتبع اللياقة البدنية المتقدمة.',
            'category_id' => 4, // Assuming category_id 4 corresponds to Fitness category
        ]);
    }
}
