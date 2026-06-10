<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class BlogController extends Controller
{

    public function index()
    {
        $posts = BlogPost::all();
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $image = new ImageService($request['photo'], 'storage/blog_photos/');
            $photoPath =  $image->upload();
        } else {
            $photoPath = null;
        }

        BlogPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('admin.blog.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = BlogPost::findOrFail($id);

        if ($request->hasFile('photo')) {
            $image = new ImageService($request['photo'], 'storage/blog_photos/');
            $photoPath =  $image->upload();
            // Delete old photo if exists
            if ($post->photo) {
                Storage::delete($post->photo);
            }
        } else {
            $photoPath = $post->photo;
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Post updated successfully.');
    }
}
