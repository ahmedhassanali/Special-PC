<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\CustomerService;
use App\Services\ImageService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use ApiResponser;

    public function __construct(private CustomerService $customerService)
    {
    }

    public function update(Request $request, Customer $customer)
    {
        try {
            $customer = $this->customerService->update($request->all() , $customer->id);
            return $this->successResponse($customer, 'Customer_Updated_Successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function show(Customer $customer)
    {
        try {
            $customer = Customer::find($customer->id);
            return $this->successResponse($customer, 'success');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::find($id);
            if ($customer->image){
                $data['image'] = ImageService::delete($customer->image);
            }
            $customer->delete();
            return $this->successResponse('success', 'Deleted Successfuly');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
