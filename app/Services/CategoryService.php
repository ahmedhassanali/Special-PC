<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{

    public function find(int $id)
    {
        return Category::find($id);
    }

    public function getAll()
    {
        return Category::with('subCategory')->get();
    }

    public function store(array $data)
    {
        if (isset($data['photo'])) {
            $image = new ImageService( $data[ 'photo' ], 'storage/categories/', $data['photo']->getClientOriginalName());
            $data['image'] =  $image->upload();
        }
        return Category::create($data);
    }

    public function update(array $data, int $id)
    {
        $category = $this->find($id);
        if (isset($data['photo'])) {
            $data['image'] = ImageService::update($data['photo'] , 'storage/categories/' , $data['photo']->getClientOriginalName() , $category->image);
        }
        $category->update($data);
    }

    public function delete(int $id)
    {
        $category = $this->find($id);
        if ($category->image) {
            $data['image'] = ImageService::delete($category->image);
        }
        $category->delete();
    }
}
