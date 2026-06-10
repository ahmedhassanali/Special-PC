@extends('admin.layouts.admin')
@php
    $rolePermissions = [
        '1' => __('Dashboard Home'),
        '2' => __('User Manager'),
        '3' => __('setting'),
        '4' => __('Account'),
        '5' => __('Category'),
        '6' => __('SubCategory'),
        '7' => __('Products'),
        '8' => __('Orders'),
        '9' => __('Brands'),
        '10' => __('Units'),
        '11' => __('Offers'),
        '12' => __('Sliders'),
        '24' => __('Marketers'),
        '13' => __('Customers'),
        '14' => __('Reports'),
        '15' => __('Feedbacks'),
        '16' => __('Payments'),
        '17' => __('Coupons'),
        '18' => __('Areas'),
        '19' => __('Cities'),
        '20' => __('Captains'),
        '21' => __('Translations'),
        '22' => __('Blog'),
        '23' => __('Users Cart'),
    ];
@endphp
@section('content')
    <div class="col-xl-12">
        <!-- Edit profile START -->
        <div class="card">
            <div class="row mb-3">
                <div class="col-12 my-2 d-flex justify-content-between">
                    <h4 class="h4 mt-3 mx-3 mb-sm-0">
                        {{ __('dashboard.manage_users') }}
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <!-- Form -->
                <form class="row g-4" action="{{ route('admin.manager.roleUpdateOrCreate', isset($role) ? $role->id : 0) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--  name -->
                    <div class="col-12">
                        <label class="form-label">{{ __('dashboard.role_name') }}</label>
                        <div class="input-group">
                            <input type="text" name="role" class="form-control"
                                value="{{ isset($role) ? $role->role : old('role') }}" placeholder="role name">
                        </div>
                    </div>

                    <!--  permissions -->
                    <div class="col-12">
                        <label class="form-label">{{ __('dashboard.permissions') }}</label>
                        <div class="input-group row">
                            @foreach ($rolePermissions as $key => $value)
                                @if (in_array($key, explode(',', auth()->user()->user_role->permission)))
                                    <div class="custom-control custom-checkbox col-md-3">
                                        <input type="checkbox" class="custom-control-input" id="{{ $key }}"
                                            name="permission[]" value="{{ $key }}"
                                            {{ isset($role) && $role->hasPermissionTo($key) ? 'checked' : '' }}>
                                        <label class="custom-control-label"
                                            for="{{ $key }}">{{ $value }}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>




                    <!-- Save button -->
                    <div class="d-sm-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-0">{{ __('dashboard.save') }}</button>
                    </div>
                </form>
            </div>
            <!-- Card body END -->
        </div>
        <!-- Edit profile END -->

        <!--  check errors -->

        @if (session('errors'))
            <div class="alert alert-success">
                {{ session('errors') }}
            </div>
        @endif


        <!--  check errors END -->


    </div>
@endsection
