@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0"> {{ __('dashboard.products') }}</h4>
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary mx-3 mt-3">
                    {{ __('dashboard.add_product') }}
                </a>
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
            </div>

            <div class="card-body">
                <div class="table-responsive border-0">
                    <table class="table align-middle p-4 mb-0 table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="border-0 "> {{ __('dashboard.image') }}</th>
                                <th scope="col" class="border-0 "> {{ __('dashboard.name') }}</th>
                                <th scope="col" class="border-0 "> {{ __('dashboard.brand') }}</th>
                                <!-- <th scope="col" class="border-0 "> {{ __('dashboard.color') }}</th>
                                <th scope="col" class="border-0 "> {{ __('dashboard.weight') }}</th>
                                <th scope="col" class="border-0 "> {{ __('dashboard.product_unit') }}</th> -->
                                <th scope="col" class="border-0 "> {{ __('dashboard.price') }}</th>
                                <th scope="col" class="border-0 ">{{ __('dashboard.in_stock') }}</th>
                                <th scope="col" class="border-0"> {{ __('dashboard.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <div class="avatar avatar-md">
                                            <img src="{{ $product->image ? asset($product->image) : asset('assets/images/default.png') }}"
                                                alt="..." class="avatar-img rounded-circle">
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">{{ $product->en_name ? $product->en_name : '-' }}</h6>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">{{ $product->brand ? $product->brand->en_name : '-' }}
                                            </h6>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">{{ $product->price ? $product->price : '-' }}</h6>
                                        </div>
                                    </td>

                                    <!-- <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">{{ $product->color ? $product->color->en_name : '-' }}
                                            </h6>
                                        </div>
                                    </td>
                           
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">{{ $product->weight ? $product->weight : '-' }}kg</h6>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">{{ $product->unit ? $product->unit->en_name : '-' }}</h6>
                                        </div>
                                    </td> -->

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">{{ $product->stock }}</h6>
                                        </div>
                                    </td>

                                    <td style="min-width: 160px;">
                                        <a href="{{ route('admin.product.edit', $product->id) }}"
                                            class="link">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button subject_id="{{ $product->id }}" id="deleteSubject"
                                            class="link text-red">
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
    @include('admin.layouts.delete', ['route' => route('admin.product.delete', ':id')])

    {{-- @include('admin.product.scripts') --}}
