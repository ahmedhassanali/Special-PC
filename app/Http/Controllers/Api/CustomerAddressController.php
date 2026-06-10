<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\CustomerAddress;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    use ApiResponser;

    public function index($id)
    {
        try {
            $addresses = CustomerAddress::where('customer_id',$id)->get();
            $addresses = $addresses->map(function ($address) {
                $address->area =  Area::where('id', $address->area_id)->WithTranslatedFields()->first();
                $address->city =  City::where('id', $address->city_id)->WithTranslatedFields()->first();
                return $address;
            });
            return $this->successResponse($addresses, 'Customer_addresses', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function store(Request $request)
    {
        try {
            $address = CustomerAddress::create($request->all());
            return $this->successResponse($address, 'address_added_Successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $address = CustomerAddress::find($id);
            $address = $address->update($request->all());
            return $this->successResponse($address, 'Address_Updated_Successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function show(CustomerAddress $customerAddress)
    {
        try {
            $customerAddress = CustomerAddress::find($customerAddress->id);
            $customerAddress->area =  Area::where('id', $customerAddress->area_id)->WithTranslatedFields()->get();
            $customerAddress->city =  City::where('id', $customerAddress->city_id)->WithTranslatedFields()->get();
            return $this->successResponse($customerAddress, 'success');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $customerAddress = CustomerAddress::find($id);
            $customerAddress->delete();
            return $this->successResponse('success', 'Deleted Successfuly');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
