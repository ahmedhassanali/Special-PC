<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        try {
            $customers =  Customer::get();
            return view('admin.customer.index' , compact('customers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.customer.create');
    }

    public function store(Request $request)
    {
        try {
            if (isset($request['photo'])) {
                $image = new ImageService( $request[ 'photo' ], 'storage/customers/');
                $request['image'] =  $image->upload();
            }
            Customer::create($request->all());
            return redirect()->route('admin.customer.index')->with('success', 'تم حفظ القسم بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('admin.customer.update' , compact('customer'));
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        $addresses = $customer->addresses;
        return view('admin.customer.show' , compact('customer','addresses'));
    }

    public function customerOrders($id)
    {
        try {
            $customer = Customer::find($id);
            $orders = $customer->orders;
            return view('admin.order.index' , compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $customer = Customer::find($id);
            if (isset($request['photo'])) {
                $request['image'] = ImageService::update($request['photo'] , 'storage/categories/', $customer->image);
            }
            $customer->update($request->all());
            return redirect()->route('admin.customer.index')->with('success', 'تم تعديل بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $customer = Customer::find($id);
            if ($customer->image) {
                $data['image'] = ImageService::delete($customer->image);
            }
            $customer->delete();
            return redirect()->route('admin.customer.index')->with('success', 'تم حذف ');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function changeStatus($id){
        try {
            $customer = Customer::find($id);

            if ($customer->status != Customer::ACTIVE)
                $customer->status = Customer::ACTIVE;
            else
                $customer->status = Customer::INACTIVE;

            $customer->save();
            return redirect()->route('admin.customer.index')->with('success', 'تم تغير حالة ');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
