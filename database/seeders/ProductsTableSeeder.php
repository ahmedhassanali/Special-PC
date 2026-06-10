<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::first();
        $subCategory = SubCategory::first();
        $brand = Brand::first();
        $unit = Unit::first();

        // Sample data for products
        Product::create([
            'ar_name' => 'منتج 1',
            'en_name' => 'Product 1',
            'sub_category_id' => $subCategory->id,
            'category_id' => $category->id,
            'ar_description' => 'وصف المنتج 1',
            'en_description' => 'Description of Product 1',
            'unit_id' => $unit->id,
            'brand_id' => $brand->id,
            'status' => Product::ACTIVE,
            'cost' => 50.00,
            'stock' => 100,
            'price' => 100.00,
            'image' => 'path/to/product1/image.jpg',
        ]);

        Product::create([
            'ar_name' => 'منتج 2',
            'en_name' => 'Product 2',
            'sub_category_id' => $subCategory->id,
            'category_id' => $category->id,
            'ar_description' => 'وصف المنتج 2',
            'en_description' => 'Description of Product 2',
            'unit_id' => $unit->id,
            'brand_id' => $brand->id,
            'status' => Product::ACTIVE,
            'cost' => 60.00,
            'stock' => 120,
            'price' => 120.00,
            'image' => 'path/to/product2/image.jpg',
        ]);

        Product::create([
            'ar_name' => 'منتج 3',
            'en_name' => 'Product 3',
            'sub_category_id' => $subCategory->id,
            'category_id' => $category->id,
            'ar_description' => 'وصف المنتج 3',
            'en_description' => 'Description of Product 3',
            'unit_id' => $unit->id,
            'brand_id' => $brand->id,
            'status' => Product::ACTIVE,
            'cost' => 70.00,
            'stock' => 80,
            'price' => 150.00,
            'image' => 'path/to/product3/image.jpg',
        ]);

        Product::create([
            'ar_name' => 'منتج 4',
            'en_name' => 'Product 4',
            'sub_category_id' => $subCategory->id,
            'category_id' => $category->id,
            'ar_description' => 'وصف المنتج 4',
            'en_description' => 'Description of Product 4',
            'unit_id' => $unit->id,
            'brand_id' => $brand->id,
            'status' => Product::ACTIVE,
            'cost' => 80.00,
            'stock' => 90,
            'price' => 160.00,
            'image' => 'path/to/product4/image.jpg',
        ]);

        Product::create([
            'ar_name' => 'منتج 5',
            'en_name' => 'Product 5',
            'sub_category_id' => $subCategory->id,
            'category_id' => $category->id,
            'ar_description' => 'وصف المنتج 5',
            'en_description' => 'Description of Product 5',
            'unit_id' => $unit->id,
            'brand_id' => $brand->id,
            'status' => Product::ACTIVE,
            'cost' => 90.00,
            'stock' => 150,
            'price' => 180.00,
            'image' => 'path/to/product5/image.jpg',
        ]);

        Product::create([
            'ar_name' => 'منتج 6',
            'en_name' => 'Product 6',
            'sub_category_id' => $subCategory->id,
            'category_id' => $category->id,
            'ar_description' => 'وصف المنتج 6',
            'en_description' => 'Description of Product 6',
            'unit_id' => $unit->id,
            'brand_id' => $brand->id,
            'status' => Product::ACTIVE,
            'cost' => 100.00,
            'stock' => 200,
            'price' => 200.00,
            'image' => 'path/to/product6/image.jpg',
        ]);
    }
}
