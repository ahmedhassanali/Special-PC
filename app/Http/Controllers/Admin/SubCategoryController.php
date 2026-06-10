<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\ImageService;

class SubCategoryController extends Controller
{


    public function index($id)
    {
        try {
            $category = Category::find($id);
            $subCategories = SubCategory::where('category_id' , $category->id)->get();
            return view('admin.subCategory.index' , compact('category','subCategories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getAll($id)
    {
        try {
            $category = Category::find($id);
            $subCategories = SubCategory::where('category_id' , $category->id)->get();
            return $subCategories;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create($category)
    {
        $category = Category::find($category);
        return view('admin.subCategory.create' ,compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            if (isset($request['photo'])) {
                $image = new ImageService( $request[ 'photo' ], 'storage/subCategories/');
                $request['image'] =  $image->upload();
            }
             $subCategory = SubCategory::create($request->all());
             return redirect()->route('admin.subCategory.index' , $subCategory->category_id)->with('success', 'تم حفظ القسم بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $subCategory = SubCategory::find($id);
        return view('admin.subCategory.update' , compact('subCategory'));
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $subCategory = SubCategory::find($id);
            if (isset($request['photo'])) {
                $request['image'] = ImageService::update($request['photo'] , 'storage/subCategories/' , $subCategory->image);
            }
            $subCategory->update($request->all());
            return redirect()->route('admin.subCategory.index' , $subCategory->category_id)->with('success', 'تم تعديل القسم بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $subCategory = SubCategory::find($id);
            if ($subCategory->image) {
                ImageService::delete($subCategory->image);
            }
            $subCategory->delete();
            return redirect()->route('admin.subCategory.index' , $subCategory->category_id)->with('success', 'تم حذف ');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function subCategories($subCategory)
    {
        try {
            $category = Category::find($subCategory);
            return $category->subCategory;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
