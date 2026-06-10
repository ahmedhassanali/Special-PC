<?php

namespace App\Services;

use App\Models\Agent;
use App\Models\User;

class UserService
{
    public function find(int $id)
    {
        return User::find($id);
    }

    public function getAll()
    {
        return User::get();
    }

    public function store(array $data)
    {
        if (isset($data['photo'])) {
            $image = new ImageService($data['photo'], 'storage/users/', $data['photo']->getClientOriginalName());
            $data['image'] =  $image->upload();
        }
        return User::create($data);
    }

    public function update(array $data, int $id)
    {
        $user = $this->find($id);
        if (isset($data['photo'])) {
            $data['image'] = ImageService::update($data['photo'], 'storage/users/', $data['photo']->getClientOriginalName(), $user->image);
        }
        $user->update($data);
    }

    public function delete(int $id)
    {
        $user = $this->find($id);

        if (isset($user->image)) {
            $data['image'] = ImageService::delete($user->image);
        }

        $user->delete();
    }

    public function changeStatus($id)
    {
        $user = User::find($id);

        // if ($user->status != User::ACTIVE)
        //     $user->status = User::ACTIVE;
        // else
        //     $user->status = User::NONACTIVE;

        $user->save();
        return redirect()->back();
    }
}
