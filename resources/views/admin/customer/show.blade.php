@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 my-2 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0"> 
                    {{ __('dashboard.customer_profile') }}
                </h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body row">
                <div class="col-12 justify-content-center align-items-center">
                    <label class="form-label">{{ __('dashboard.image') }} </label>
                    <div class="d-flex align-items-center">
                        <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                            <span class="">
                                <img width="150" id="uploadfile-1-preview" class=" border border-white border-3"
                                    src="{{ isset($customer) ? asset($customer->image) : 'https://via.placeholder.com/150' }}"
                                    alt="" accept="image/*">
                            </span>
                        </label>
                    </div>
                </div>

                <div class="col-md-6 mt-1">
                    <label class="form-label">{{ __('dashboard.name') }}</label>
                    <div class="input-group">
                        <label class="form-control">{{ $customer->name }}</label>
                    </div>
                </div>

                <div class="col-md-6 mt-1">
                    <label class="form-label">{{ __('dashboard.email') }}</label>
                    <div class="input-group">
                        <label class="form-control">{{ $customer->email }}</label>
                    </div>
                </div>

                <div class="col-md-6 mt-1">
                    <label class="form-label">{{ __('dashboard.phone') }}</label>
                    <div class="input-group">
                        <label class="form-control">{{ $customer->phone }}</label>
                    </div>
                </div>

                <div class="col-md-6 mt-1">
                    <label class="form-label">{{ __('dashboard.gender') }}</label>
                    <div class="input-group">
                        <label
                            class="form-control">{{ $customer->gender == App\Models\Customer::MALE ? 'Male ' : 'Female' }}</label>
                    </div>
                </div>

                <div class="col-md-12 mt-1">
                    <label class="form-label">{{ __('dashboard.age') }}</label>
                    <div class="input-group">
                        <label class="form-control">{{ $customer->age }}</label>
                    </div>
                </div>

                <div class="col-md-12 mt-1">
                    <label class="form-label">{{ __('dashboard.wallet') }}</label>
                    <div class="input-group">
                        <label class="form-control">{{ $customer->wallet }}</label>
                    </div>
                </div>

                <div class="col-md-12 mt-1">
                    <label class="form-label">{{ __('dashboard.addresses') }}</label>
                    <div class="card">
                        @foreach ($customer->addresses as $address)
                            <span class="mx-2 ">{{ $address->title }} :</span>
                            <div class="input-group ">
                                <label class="form-control mx-2 mb-2">{{ $address->address }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
