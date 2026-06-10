<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerService
{
    public function update(array $data, int $id)
    {
        $data['status'] = Customer::OLDUSER;
        if (isset($data['password'])) {
        $data['password'] = Hash::make($data['password']);
        }

        $customer = Customer::find($id);
        if (isset($data['photo'])) {
            $data['image'] = ImageService::update($data['photo'] , 'storage/customers/' , $data['photo']->getClientOriginalName() , $customer->image);
        }
        // dd($data);
        return $customer->update($data);
    }

}
