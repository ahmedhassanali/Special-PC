<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\ImageUpload;
use App\Http\Requests\Admin\UpdateRequest;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // get profile page
    public function index()
    {
        $user = User::find(auth()->user()->id);
         return view('admin.account.profile', compact('user'));
    }

    // setting profile
    public function setting()
    {
         $user = User::find(auth()->user()->id);
         return view('admin.account.setting', compact('user'));
    }


    // update profile
    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $request['image'] = ImageService::update( $image, 'storage/admins/', $user->image);
        }

        $request->merge(['password' => Hash::make($request->password)]);
        $user->update($request->all());
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully');
    }


}
