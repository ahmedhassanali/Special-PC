@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">
                    {{ __('dashboard.order') }} :                    
                    <span class="text-default">
                        {{ __('ecommerce.order_number') }} #{{ $order->id }}
                    </span>
                </h4>
                <button class="btn btn-primary mx-3 mt-3" onclick="window.print();">
                    طباعه
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                 <div class="table-responsive border-0">
                    <table class="table align-middle p-4 mb-0 table-hover">
                        <thead class="table-light">
                        <tr>
                            <th class="border-0">العميل</th>
                            <th class="border-0">رقم الجوال</th>
                            <th class="border-0">تاريخ الطلب</th>
                            <th class="border-0">المدينة / العنوان</th>
                            <th class="border-0"> {{ __('dashboard.status') }}</th>
                              <th class="border-0"> الاجمالي</th>
                              <th class="border-0">  حالة الدفع</th>
                            <th class="border-0">  طريقة الدفع</th>
                        </tr>

                        </thead>
                        <tbody>
                                <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                             <a href="{{ route('admin.customer.show', $order->customer_id) }}">
                                                {{ $order->customer->name }}
                                            </a>
                                            <h6 class="mb-0">{{ __('dashboard.customer_name') }}</h6>
                                        </div>
                                </td>

                                <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">
                                                0100000029
                                            </h6>
                                        </div>
                                </td>

                                <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">{{ __('ecommerce.order_date') }}</h6>
                                        </div>
                                </td>

                                <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0"> 
                                                {{ $order->address->city->name }} / 
                                                {{ $order->address->area->name }} /
                                                {{ $order->address->address }}
                                            </h6>
                                        </div>
                                </td>

                                <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <div class="input-group">
                                            @if ($order->status == App\Models\Order::ORDERED)
                                            <span class="badge teal"> {{ __('dashboard.ordered') }}</span>
                                            @elseif ($order->status == App\Models\Order::PROCESSING)
                                            <span class="badge green"> {{ __('dashboard.processing') }}</span>
                                            @elseif ($order->status == App\Models\Order::PREORDERED)
                                            <span class="badge green"> {{ __('dashboard.preordered') }}</span>
                                            @elseif ($order->status == App\Models\Order::SHIPPING)
                                            <span class="badge bg-warning"> {{ __('dashboard.shipping') }}</span>
                                            @elseif ($order->status == App\Models\Order::DELIVERED)
                                            <span class="badge bg-warning"> {{ __('dashboard.delivered') }}</span>
                                            @elseif ($order->status == App\Models\Order::FINISHED)
                                            <span class="badge green"> {{ __('dashboard.finished') }}</span>
                                            @elseif ($order->status == App\Models\Order::CANCELLED)
                                            <span class="badge red"> {{ __('dashboard.cancelled') }}</span>
                                            @elseif ($order->status == App\Models\Order::RETURNED)
                                            <span class="badge red"> {{ __('dashboard.returned') }}</span>
                                            @endif
                                            </div>
                                        </div>
                                </td>

                                <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">
                                                 {{ __('dashboard.total') }}
                                            </h6>
                                        </div>
                                </td>

                                <td class="text-center">
                                          <span class="badge teal">{{ __('dashboard.paid') }}
                                            <i class="fas fa-check-circle"></i>
                                        </span>
                                </td>
                                  
                                <td class="text-center">
                                    <span class="badge bg-secondary">card</span>
                                </td>  
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive border-0">
                    <table class="table align-middle p-4 mb-0 table-hover">
                        <thead class="table-light">
                        <tr>
                            <th class="border-0">{{ __('dashboard.product') }}</th>
                             <!-- <td class="text-muted fs-12"> {{ __('dashboard.quantity') }}</td> -->
                            <th class="border-0">السعر</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                      <div class="avatar-md flex-shrink-0 me-2">
                                        <span class="avatar-title bg-primary-subtle rounded-circle">
                                            <img src="{{ asset($item->product->image) }}" alt="" height="22">
                                        </span>
                                      </div>
                                        <h5 class="fs-14 mt-1">    {{ $item->product->name }}</h5>
                                    </div>
                                </td>
                                <!-- <td>
                                    <p class="text-default fs-14">
                                                {{ __('ecommerce.products_count') }}::
                                                {{ $item->quantity }}
                                            </p>
                                </td>  -->
                                <td>           
                                    <p class="text-default fs-14">
                                    {{ __('ecommerce.price') }}:
                                    {{ $item->itemPrice() }}
                                    </p>
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
