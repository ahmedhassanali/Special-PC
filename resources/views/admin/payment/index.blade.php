@php
    $setting = \App\Models\Setting::first();
@endphp
@extends('admin.layouts.admin')

@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.payments') }}</h4>
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
                                <i class="fas fa-search fs-6"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Search and select END -->
        </div>

        <div class="card-body">
            <div class="table-responsive border-0">
                <table class="table align-middle p-4 mb-0 table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="border-0 rounded-start">{{ __('dashboard.customer_name') }}</th>
                            <th scope="col" class="border-0">{{ __('dashboard.ID') }}</th>
                            <th scope="col" class="border-0">{{ __('dashboard.payment_status') }}</th>
                            <th scope="col" class="border-0">{{ __('dashboard.payment_method') }}</th>
                            <th scope="col" class="border-0">{{ __('dashboard.total') }}</th>
                            <th scope="col" class="border-0">{{ __('dashboard.date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center position-relative">
                                        <div class="mb-0 ms-2">
                                            <!-- Title -->
                                            <h6><a href="#" class="stretched-link">
                                                    {{ $payment->customer->name }}
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <h6>
                                        {{ $payment->order_id ? $payment->order_id : '-' }}
                                    </h6>
                                </td>

                                <td>
                                    @if ($payment->payment_status == 'paid')
                                        <span class="badge teal">{{ __('dashboard.paid') }}
                                            <i class="fas fa-check-circle"></i>
                                        </span>
                                    @elseif ($payment->payment_status == 'refunded')
                                        <span class="badge bg-warning">{{ __('dashboard.refunded') }}
                                             <i class="fas fa-times-circle"></i>
                                            </span>
                                    @else
                                        <span class="badge red">{{ __('dashboard.pending') }}
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                    @endif
                                </td>

                                <td>   
                                    <span class="badge bg-secondary">{{ $payment->payment_method }}</span>
                                    <!-- <span class="badge cash">{{ $payment->payment_method }}</span> -->
                                </td>

                                <td>{{ $payment->amount }} SAR</td>

                                <td>
                                    {{ $payment->updated_at }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $payments->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
