<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'image' => 'path/to/category1/image.jpg',
            'ar_title' => 'أجهزة الكمبيوتر',
            'en_title' => 'Computers',
            'ar_description' => 'تشمل هذه الفئة أجهزة الكمبيوتر المكتبية والمحمولة وأجهزة التابلت.',
            'en_description' => 'This category includes desktop computers, laptops, and tablets.',
        ]);

        Category::create([
            'image' => 'path/to/category2/image.jpg',
            'ar_title' => 'الهواتف الذكية',
            'en_title' => 'Smartphones',
            'ar_description' => 'تحتوي هذه الفئة على مجموعة متنوعة من الهواتف الذكية من مختلف الشركات العالمية.',
            'en_description' => 'This category contains a variety of smartphones from different global manufacturers.',
        ]);

        Category::create([
            'image' => 'path/to/category3/image.jpg',
            'ar_title' => 'أثاث المنزل',
            'en_title' => 'Home Furniture',
            'ar_description' => 'فئة تحتوي على أثاث المنزل بمختلف أنواعه وتصاميمه لتلبية احتياجات المنزل.',
            'en_description' => 'A category containing various types and designs of home furniture to meet household needs.',
        ]);

        Category::create([
            'image' => 'path/to/category4/image.jpg',
            'ar_title' => 'الملابس',
            'en_title' => 'Clothing',
            'ar_description' => 'تتضمن هذه الفئة مجموعة واسعة من الملابس بمختلف الأنماط والمقاسات للجنسين.',
            'en_description' => 'This category includes a wide range of clothing items in various styles and sizes for both genders.',
        ]);
    }
}
