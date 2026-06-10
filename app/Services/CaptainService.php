<?php

namespace App\Services;

use App\Models\captain;
use Illuminate\Support\Facades\Hash;

class CaptainService
{
    public function update(array $data, int $id)
    {
        $data['status'] = Captain::OLDUSER;
        if (isset($data['password'])) {
        $data['password'] = Hash::make($data['password']);
        }

        $captain = Captain::find($id);
        if (isset($data['photo'])) {
            $data['image'] = ImageService::update($data['photo'] , 'storage/captains/' , $data['photo']->getClientOriginalName() , $captain->image);
        }
        return $captain->update($data);
    }

}
