<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\ImageService;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories =  Category::with('subCategory')->get();
            return view('admin.category.index' , compact('categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            if (isset($request['photo'])) {
                $image = new ImageService( $request[ 'photo' ], 'storage/categories/');
                $request['image'] =  $image->upload();
            }
            Category::create($request->all());
            return redirect()->route('admin.category.index')->with('success', 'تم حفظ القسم بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.update' , compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $category =Category::find($id);
            if (isset($request['photo'])) {
                $request['image'] = ImageService::update($request['photo'] , 'storage/categories/', $category->image);
            }
            $category->update($request->all());
            return redirect()->route('admin.category.index')->with('success', 'تم تعديل القسم بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $category = Category::find($id);
            if ($category->image) {
                $data['image'] = ImageService::delete($category->image);
            }
            $category->delete();
            return redirect()->route('admin.category.index')->with('success', 'تم حذف القسم');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
