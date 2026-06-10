@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        <!-- Title -->
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0"> {{ __('dashboard.brands') }}</h4>
                <a href="{{ route('admin.brand.create') }}" class="btn btn-primary mx-3 mt-3">{{ __('dashboard.add_brand') }}</a>
            </div>
        </div>

        <div class="card">
            <div class="p-3">
                <div class="row g-3 align-items-center justify-content-between">
                    <!-- Search bar -->
                    <div class="col-md-12">
                        <form class="rounded position-relative">
                            <input class="form-control bg-body" type="search" placeholder="Search" aria-label="Search">
                            <button class="link text-gray px-3 py-0 position-absolute top-50 end-0 translate-middle-y"
                                type="submit">
                                <i class="fas fa-search fs-6 "></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Search and select END -->
            </div>
            <!-- Card header END -->

            <!-- Card body START -->
            <div class="card-body">
                <!-- Instructor request table START -->
                <div class="table-responsive border-0">
                    <table class="table align-middle p-4 mb-0 table-hover">
                        <!-- Table head -->
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="border-0 ">{{ __('dashboard.image') }}</th>
                                <th scope="col" class="border-0 ">{{ __('dashboard.name') }}</th>
                                <th scope="col" class="border-0">{{ __('dashboard.actions') }}</th>
                            </tr>
                        </thead>
                        <!-- Table body START -->

                        <tbody>
                            <!-- Table row -->
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>
                                        <div class="avatar avatar-md mx-2">
                                            <img src="{{ $brand->image ? asset($brand->image) : asset('assets/images/default.png') }}" alt="..." style="width: 100px"
                                                class="avatar-img rounded-circle">
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">
                                                <a
                                                    href="{{ route('admin.brand.edit', $brand->id) }}">{{ $brand->en_name }}</a>
                                            </h6>
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.brand.edit', $brand->id) }}" class="link">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <button subject_id="{{ $brand->id }}" id="deleteSubject" class="link text-red">
                                             <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
    @include('admin.layouts.delete',['route' => route('admin.brand.delete', ':id') ])
