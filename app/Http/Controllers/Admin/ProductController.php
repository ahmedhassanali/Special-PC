<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\Unit;
use App\Models\Color;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products =  Product::get();
            return view('admin.product.index', compact('products'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        $offers = Offer::get();
        $categories = Category::get();
        $units = Unit::get();
        $colors = Color::get();
        $brands = Brand::get();
        $subCategories = SubCategory::get();
        return view('admin.product.create', compact('categories', 'units', 'brands', 'colors', 'subCategories', 'offers'));
    }

    public function store(Request $request)
    {
        try {
            if (isset($request['photo'])) {
                $image = new ImageService($request['photo'], 'storage/products/');
                $request['image'] =  $image->upload();
            }

            $product = product::create($request->all());

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $image = new ImageService($photo, 'storage/products/' . $product->id . '/');
                    $imageData['product_id'] = $product->id;
                    $imageData['image'] =  $image->upload();
                    ProductImage::create($imageData);
                }
            }

            return redirect()->route('admin.product.index')->with('success', 'تم حفظ بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::get();
        $units = Unit::get();
        $brands = Brand::get();
        $colors = Color::get();
        $subCategories = SubCategory::get();
        $offers = Offer::get();
        return view('admin.product.update', compact('product', 'categories', 'units','colors', 'brands', 'subCategories', 'offers'));
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            if (isset($request['photo'])) {
                $request['image'] = ImageService::update($request['photo'], 'storage/products/', $product->image);
            }

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $image = new ImageService($photo, 'storage/products/' . $product->id . '/');
                    $imageData['product_id'] = $product->id;
                    $imageData['image'] =  $image->upload();
                    ProductImage::create($imageData);
                }
            }

            $product->update($request->all());
            return redirect()->route('admin.product.index')->with('success', 'تم تعديل بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $product =  Product::find($id);
            if ($product->image) {
                $data['image'] = ImageService::delete($product->image);
            }
            $product->delete();
            return redirect()->route('admin.product.index')->with('success', 'تم حذف ');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteImage($id)
    {
        try {
            $image = ProductImage::where('id', $id)->first();
            ImageService::delete($image->image);
            $image->delete();
            return redirect()->back()->with('success', 'تم حذف الصورة');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


}
