@extends('admin.layouts.admin')

@section('content')
<div class="page-content-wrapper m-3">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between">
            <h4>
                 عربات المستخدمين
            </h4>
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
                                <th scope="col" class="border-0"> {{ __('dashboard.client') }}</th>
                                <th scope="col" class="border-0"> {{ __('dashboard.phone_number') }}</th>
                                <!-- <th scope="col" class="border-0"> {{ __('dashboard.email') }}</th> -->
                                <th scope="col" class="border-0"> {{ __('dashboard.cart') }}</th>
                                <th scope="col" class="border-0">{{ __('dashboard.total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                                $quantity = 0;
                                @endphp
                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">
                                           {{ $cart->customer->name }}
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">
                                                0500000
                                            </h6>
                                        </div>
                                    </td>

                                    <!-- <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">
                                                {{ $cart->customer->email }}
                                            </h6>
                                        </div>
                                    </td> -->


                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">
                                                @if (isset($settings->tax))
                                                {{ number_format($total + $total * ($settings->tax / 100), 2) }} 
                                                    ريال 
                                                @else
                                                {{ number_format($total, 2) }} {{ __('ecommerce.currency') }}
                                              @endif
                                            </h6>
                                        </div>
                                    </td>

                                    <td>
                                        <a class="btn btn-sm btn-primary" href="">
                                            عرض السله
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection
