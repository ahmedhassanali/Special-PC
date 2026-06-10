<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\CustomerService;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(private CustomerService $customerService)
    {
    }

    public function update(Request $request, Customer $customer)
    {
        try {
            $customer = $this->customerService->update($request->all(), $customer->id);
            return redirect()->back()->with('success', 'Customer_Updated_Successfully');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function show(Customer $customer)
    {
        try {
            $customer = Customer::find($customer->id);
            return $this->successResponse($customer, 'success');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::find($id);
            if ($customer->image) {
                $data['image'] = ImageService::delete($customer->image);
            }
            $customer->delete();
            return redirect()->route('home')->with('success', 'Deleted Successfuly');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return view('ecommerce.layouts.catch', compact('message'));
        }
    }
}
