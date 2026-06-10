<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAddressController extends Controller
{
    public function index($id)
    {
        try {
            $addresses = CustomerAddress::where('customer_id', $id)->get();
            $addresses = $addresses->map(function ($address) {
                $address->area =  Area::where('id', $address->area_id)->WithTranslatedFields()->first();
                $address->city =  City::where('id', $address->city_id)->WithTranslatedFields()->first();
                return $address;
            });
            return $this->successResponse($addresses, 'Customer_addresses', 200);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function store(Request $request)
    {
        try {

            $customer =  Auth::guard('ecommerce')->user();

            if (isset($request['default'])) {
                $request['default'] = 1 ;
                $customer->addresses()->update(['default' => false]);
            }
            $address = CustomerAddress::create($request->all());
            return redirect()->back()->with( 'success' , 'address_added_Successfully');

        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $address = CustomerAddress::find($id);
            $customer =  Auth::guard('ecommerce')->user();

            if ($request['default']) {
                $request['default'] = 1 ;
                $customer->addresses()->update(['default' => false]);
            }

            $address = $address->update($request->all());
            return $this->successResponse($address, 'Address_Updated_Successfully', 200);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function destroy($id)
    {
        try {
            $customerAddress = CustomerAddress::find($id);
            $customerAddress->delete();
            return redirect()->back()->with( 'success' ,'Deleted Successfuly');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }
}
