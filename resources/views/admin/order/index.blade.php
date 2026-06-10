@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0"> {{ __('dashboard.orders') }}</h4>
            </div>
        </div>

        <div class="card">
            <div class="p-3">
                <div class="list-group" id="list-tab" role="tablist">
                        <div class="col-2">
                            <a class="list-group-item list-group-item-action active" id="list-pending-list" data-bs-toggle="list" href="#list-pending" role="tab" aria-controls="list-pending">
                                <i class="bi bi-arrow-clockwise"></i>
                                <div class="d-flex justify-content-between">
                                    <p class="text-teal">
                                       <i class="bi bi-circle-fill"></i>
                                        قيد التنفيذ
                                    </p>
                                    <h5>18</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-2">
                            <a class="list-group-item list-group-item-action" id="list-done-list" data-bs-toggle="list" href="#list-done" role="tab" aria-controls="list-done">
                                <i class="bi bi-bag-check"></i>
                                <div class="d-flex justify-content-between">
                                    <p class="text-pink">
                                       <i class="bi bi-circle-fill"></i>
                                        تم التنفيذ
                                    </p>
                                    <h5>10</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-2">
                            <a class="list-group-item list-group-item-action" id="list-deliver-list" data-bs-toggle="list" href="#list-deliver" role="tab" aria-controls="list-deliver">
                               <i class="bi bi-truck"></i>
                                <div class="d-flex justify-content-between">
                                    <p class="text-primary">
                                       <i class="bi bi-circle-fill"></i>
                                       جاري التوصيل
                                    </p>
                                    <h5>10</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-2">
                            <a class="list-group-item list-group-item-action" id="list-payment-list" data-bs-toggle="list" href="#list-payment" role="tab" aria-controls="list-payment">
                               <i class="bi bi-cash"></i>
                                <div class="d-flex justify-content-between">
                                    <p class="text-green">
                                       <i class="bi bi-circle-fill"></i>
                                       بانتظار الدفع
                                    </p>
                                    <h5>10</h5>
                                </div>
                            </a>
                        </div>

                        <div class="col-2">
                            <a class="list-group-item list-group-item-action" id="list-del-list" data-bs-toggle="list" href="#list-del" role="tab" aria-controls="list-del">
                               <i class="bi bi-trash"></i>
                                <div class="d-flex justify-content-between">
                                    <p class="text-red">
                                       <i class="bi bi-circle-fill"></i>
                                       محذوف
                                    </p>
                                    <h5>10</h5>
                                </div>
                            </a>
                        </div>

                </div>
                <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-pending" role="tabpanel" aria-labelledby="list-pending-list">
                            <div class="table-responsive border-0">
                                <table class="table align-middle mb-0 table-hover table-sm" id="dataTable">
                                     <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">{{ __('dashboard.customer') }}</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.total') }}</th>
                                            <th class="border-0">  حالة الدفع</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.city') }}</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.address') }}</th>
                                            <!-- <th scope="col" class="border-0">{{ __('dashboard.shipping_fees') }}</th> -->
                                            <th scope="col" class="border-0">{{ __('dashboard.status') }}</th>
                                            <th scope="col" class="border-0" style="width: 320.031px;">{{ __('dashboard.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>
                                                        <a href="{{ route('admin.customer.show', $order->customer_id) }}">
                                                            {{ $order->customer->name }}
                                                        </a>
                                                    </p>
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ $order->total }} SAR</p>
                                                </div>
                                            </td>

                                             <td class="text-center">
                                                <span class="badge teal">{{ __('dashboard.paid') }}
                                                    <i class="fas fa-check-circle"></i>
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->address) ? $order->address->city->en_name : '' }}</p>
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->address) ? $order->address->address : '' }}</p>
                                                </div>
                                            </td>
                                            <!-- <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->shipping_fees) ? $order->shipping_fees : '' }} SAR</p>
                                                </div>
                                            </td> -->
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    @if ($order->status == App\Models\Order::ORDERED)
                                                        <span class="badge green"> {{ __('dashboard.ordered') }}</span>
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
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center position-relative gap-3" style="width:100%;">
                                                    <button class="link text-dark" onclick="window.print();">
                                                        <i class="bi bi-printer-fill"></i>
                                                    </button>
                                                    <a href="{{ route('admin.order.show', $order->id) }}" class="link">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.order.delivery', $order->id) }}" class="btn btn-sm btn-primary">
                                                        طلب توصيل
                                                    </a>
                                                    <select class="form-control" name="status">
                                                                <option value="">{{ __('Select Status') }}</option>
                                                                <option
                                                                    value="{{ App\Models\Order::PROCESSING }}"{{ isset($order) && $order->status == App\Models\Order::PROCESSING ? 'selected' : '' }}>
                                                                        {{ __('dashboard.processing') }} 
                                                                </option>
                                                                <option
                                                                    value="{{ App\Models\Order::PREORDERED }}"{{ isset($order) && $order->status == App\Models\Order::PREORDERED ? 'selected' : '' }}>
                                                                    {{ __('dashboard.preordered') }}
                                                                </option>
                                                                <option
                                                                     value="{{ App\Models\Order::SHIPPING }}"{{ isset($order) && $order->status == App\Models\Order::SHIPPING ? 'selected' : '' }}>
                                                                        {{ __('dashboard.shipping') }}
                                                                </option>
                                                                <option
                                                                    value="{{ App\Models\Order::DELIVERED }}"{{ isset($order) && $order->status == App\Models\Order::DELIVERED ? 'selected' : '' }}>
                                                                    {{ __('dashboard.delivered') }}
                                                                </option>
                                                                <option
                                                                    value="{{ App\Models\Order::FINISHED }}"{{ isset($order) && $order->status == App\Models\Order::FINISHED ? 'selected' : '' }}>
                                                                    {{ __('dashboard.finished') }}
                                                                </option>
                                                                <option
                                                                    value="{{ App\Models\Order::CANCELLED }}"{{ isset($order) && $order->status == App\Models\Order::CANCELLED ? 'selected' : '' }}>
                                                                    {{ __('dashboard.cancelled') }}
                                                                </option>
                                                                <option
                                                                    value="{{ App\Models\Order::RETURNED }}"{{ isset($order) && $order->status == App\Models\Order::RETURNED ? 'selected' : '' }}>
                                                                    {{ __('dashboard.returned') }} 
                                                                </option>
                                                            </select>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                       
                        <div class="tab-pane fade" id="list-done" role="tabpanel" aria-labelledby="list-done-list">
                            <div class="table-responsive border-0">
                                <table class="table align-middle mb-0 table-hover table-sm" id="dataTable">
                                     <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">{{ __('dashboard.customer') }}</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.total') }}</th>
                                            <th class="border-0">  حالة الدفع</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.city') }}</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.address') }}</th>
                                            <!-- <th scope="col" class="border-0">{{ __('dashboard.shipping_fees') }}</th> -->
                                            <th scope="col" class="border-0">{{ __('dashboard.status') }}</th>
                                            <th scope="col" class="border-0" style="width: 320.031px;">{{ __('dashboard.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>
                                                        <a href="{{ route('admin.customer.show', $order->customer_id) }}">
                                                            {{ $order->customer->name }}
                                                        </a>
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ $order->total }} SAR</p>
                                                </div>
                                            </td>
                                            
                                             <td class="text-center">
                                                <span class="badge teal">{{ __('dashboard.paid') }}
                                                    <i class="fas fa-check-circle"></i>
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->address) ? $order->address->city->en_name : '' }}</p>
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->address) ? $order->address->address : '' }}</p>
                                                </div>
                                            </td>
  
                                            <!-- <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->shipping_fees) ? $order->shipping_fees : '' }} SAR</p>
                                                </div>
                                            </td> -->
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    @if ($order->status == App\Models\Order::ORDERED)
                                                        <span class="badge green"> 
                                                            {{ __('dashboard.ordered') }}
                                                        </span>
                                                    @elseif ($order->status == App\Models\Order::PROCESSING)
                                                        <span class="badge green"> 
                                                            {{ __('dashboard.processing') }}
                                                        </span>
                                                    @elseif ($order->status == App\Models\Order::PREORDERED)
                                                    <span class="badge green"> 
                                                        {{ __('dashboard.preordered') }}
                                                    </span>
                                                    @elseif ($order->status == App\Models\Order::SHIPPING)
                                                    <span class="badge bg-warning"> 
                                                        {{ __('dashboard.shipping') }}
                                                    </span>

                                                    @elseif ($order->status == App\Models\Order::DELIVERED)
                                                    <span class="badge bg-warning">
                                                         {{ __('dashboard.delivered') }}
                                                    </span>
                                                    @elseif ($order->status == App\Models\Order::FINISHED)
                                                    <span class="badge green"> 
                                                        {{ __('dashboard.finished') }}
                                                    </span>

                                                    @elseif ($order->status == App\Models\Order::CANCELLED)
                                                    <span class="badge red"> 
                                                        {{ __('dashboard.cancelled') }}
                                                    </span>
                                                    @elseif ($order->status == App\Models\Order::RETURNED)
                                                    <span class="badge red"> 
                                                        {{ __('dashboard.returned') }}
                                                    </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center position-relative gap-3" style="width:100%;">
                                                    <button class="link text-dark" onclick="window.print();">
                                                        <i class="bi bi-printer-fill"></i>
                                                    </button>
                                                <a href="{{ route('admin.order.show', $order->id) }}" class="link">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.order.delivery', $order->id) }}" class="btn btn-sm btn-primary">
                                                    طلب توصيل
                                                </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="list-deliver" role="tabpanel" aria-labelledby="list-deliver-list">
                            <div class="table-responsive border-0">
                                <table class="table align-middle mb-0 table-hover table-sm" id="dataTable">
                                     <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">{{ __('dashboard.customer') }}</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.total') }}</th>
                                            <th class="border-0">  حالة الدفع</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.city') }}</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.address') }}</th>
                                            <!-- <th scope="col" class="border-0">{{ __('dashboard.shipping_fees') }}</th> -->
                                            <th scope="col" class="border-0">{{ __('dashboard.status') }}</th>
                                            <th scope="col" class="border-0" style="width: 320.031px;">{{ __('dashboard.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>
                                                        <a href="{{ route('admin.customer.show', $order->customer_id) }}">
                                                            {{ $order->customer->name }}
                                                        </a>
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ $order->total }} SAR</p>
                                                </div>
                                            </td>
                                                                                        
                                             <td class="text-center">
                                                <span class="badge teal">{{ __('dashboard.paid') }}
                                                    <i class="fas fa-check-circle"></i>
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->address) ? $order->address->city->en_name : '' }}</p>
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->address) ? $order->address->address : '' }}</p>
                                                </div>
                                            </td>

                                            <!-- <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->shipping_fees) ? $order->shipping_fees : '' }} SAR</p>
                                                </div>
                                            </td> -->
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    @if ($order->status == App\Models\Order::ORDERED)
                                                        <span class="badge green"> 
                                                            {{ __('dashboard.ordered') }}
                                                        </span>
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
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center position-relative gap-3" style="width:100%;">
                                                    <button class="link text-dark" onclick="window.print();">
                                                        <i class="bi bi-printer-fill"></i>
                                                    </button>
                                                <a href="{{ route('admin.order.show', $order->id) }}" class="link">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.order.delivery', $order->id) }}" class="btn btn-sm btn-primary">
                                                    طلب توصيل
                                                </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="list-payment" role="tabpanel" aria-labelledby="list-payment-list">
                            <div class="table-responsive border-0">
                                <table class="table align-middle mb-0 table-hover table-sm" id="dataTable">
                                     <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">{{ __('dashboard.customer') }}</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.total') }}</th>
                                            <th class="border-0">  حالة الدفع</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.city') }}</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.address') }}</th>
                                            <!-- <th scope="col" class="border-0">{{ __('dashboard.shipping_fees') }}</th> -->
                                            <th scope="col" class="border-0">{{ __('dashboard.status') }}</th>
                                            <th scope="col" class="border-0" style="width: 320.031px;">{{ __('dashboard.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>
                                                        <a href="{{ route('admin.customer.show', $order->customer_id) }}">
                                                            {{ $order->customer->name }}
                                                        </a>
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ $order->total }} SAR</p>
                                                </div>
                                            </td>

                                                                                        
                                             <td class="text-center">
                                                <span class="badge teal">{{ __('dashboard.paid') }}
                                                    <i class="fas fa-check-circle"></i>
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->address) ? $order->address->city->en_name : '' }}</p>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->address) ? $order->address->address : '' }}</p>
                                                </div>
                                            </td>
               
                                            <!-- <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->shipping_fees) ? $order->shipping_fees : '' }} SAR</p>
                                                </div>
                                            </td> -->
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    @if ($order->status == App\Models\Order::ORDERED)
                                                        <span class="badge green"> 
                                                            {{ __('dashboard.ordered') }}
                                                        </span>
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
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center position-relative gap-3" style="width:100%;">
                                                    <button class="link text-dark" onclick="window.print();">
                                                        <i class="bi bi-printer-fill"></i>
                                                    </button>
                                                <a href="{{ route('admin.order.show', $order->id) }}" class="link">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.order.delivery', $order->id) }}" class="btn btn-sm btn-primary">
                                                    طلب توصيل
                                                </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="list-del" role="tabpanel" aria-labelledby="list-del-list">
                            <div class="table-responsive border-0">
                                <table class="table align-middle mb-0 table-hover table-sm" id="dataTable">
                                     <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">{{ __('dashboard.customer') }}</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.total') }}</th>
                                            <th class="border-0">  حالة الدفع</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.city') }}</th>
                                            <th scope="col" class="border-0">{{ __('dashboard.address') }}</th>
                                            <!-- <th scope="col" class="border-0">{{ __('dashboard.shipping_fees') }}</th> -->
                                            <th scope="col" class="border-0">{{ __('dashboard.status') }}</th>
                                            <th scope="col" class="border-0" style="width: 320.031px;">{{ __('dashboard.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>
                                                        <a href="{{ route('admin.customer.show', $order->customer_id) }}">
                                                            {{ $order->customer->name }}
                                                        </a>
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ $order->total }} SAR</p>
                                                </div>
                                            </td>

                                                                                        
                                             <td class="text-center">
                                                <span class="badge teal">{{ __('dashboard.paid') }}
                                                    <i class="fas fa-check-circle"></i>
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->address) ? $order->address->city->en_name : '' }}</p>
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->address) ? $order->address->address : '' }}</p>
                                                </div>
                                            </td>

                                            <!-- <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    <p>{{ isset($order->shipping_fees) ? $order->shipping_fees : '' }} SAR</p>
                                                </div>
                                            </td> -->
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                                    @if ($order->status == App\Models\Order::ORDERED)
                                                        <span class="badge green"> 
                                                            {{ __('dashboard.ordered') }}
                                                        </span>
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
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center position-relative gap-3" style="width:100%;">
                                                    <button class="link text-dark" onclick="window.print();">
                                                        <i class="bi bi-printer-fill"></i>
                                                    </button>
                                                <a href="{{ route('admin.order.show', $order->id) }}" class="link">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.order.delivery', $order->id) }}" class="btn btn-sm btn-primary">
                                                    طلب توصيل
                                                </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>

        </div>
@endsection
@include('admin.layouts.delete', ['route' => route('admin.order.delete', ':id')])


<div class="printed-content">
    <div class="row mb-3">
        <div class="">
         <img src="{{ asset('assets/img/special-pc-logo-dark.png') }}" alt="" height="64">
            <h4 class="h4 mt-3 mx-3 mb-sm-0 text-default">
                رقم الطلب    
                #{{ $order->id }}
            </h4>
        </div>
    </div>

        <div class="card">
            <div class="card-body">
                 <div class="table-responsive border-0">
                    <table class="table align-middle p-4 mb-0">
                        <tbody>
                        <tr>
                            <th class="">العميل</th>
                            <td class="">
                                {{ $order->customer->name }}
                            </td>
                        </tr>

                        <tr>
                            <th class="">رقم الجوال</th>
                            <td class="">
                                0100000029
                            </td>
                        </tr>

                        <tr>
                            <th class="">تاريخ الطلب</th>
                            <td class="">
                                <h6 class="mb-0">{{ __('ecommerce.order_date') }}</h6>
                            </td>
                        </tr>

                        <tr>
                            <th class="">المدينة</th>
                                <td class="">
                                {{ $order->address->city->name }} 
                                </td>
                        </tr>

                        <tr>
                                <th class=""> {{ __('dashboard.status') }}</th>
                                <td class="">
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
                        </tr>

                        <tr>
                            <th class="">  حالة الدفع</th>
                            <td class="">
                                {{ __('dashboard.paid') }}
                                    <i class="fas fa-check-circle"></i>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>    
        </div>

    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between">
            <h4 class="h4 mt-3 mx-3 mb-sm-0">
                تفاصيل المنتجات
            </h4>
        </div>
    </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive border-0">
                    <table class="table align-middle p-4 mb-0">
                        <thead>
                        <tr>
                            <th class="">{{ __('dashboard.product') }}</th>
                            <td class=""> {{ __('dashboard.quantity') }}</td>
                            <th class="">السعر</th>
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
                                      <h5 class="fs-14 mt-1">
                                        {{ $item->product->name }}
                                      </h5>
                                    </div>
                                </td>
                                <td>
                                    <p class="">
                                        {{ $item->quantity }}
                                    </p>
                                </td>
                                <td>           
                                    <p>
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

        <div class="bg-gray m-3 p-4 d-flex align-items-center">
            <h4 class="text-default mx-4">الأجمالي</h4>
            <h4 class="text-dark">2897 ريال</h4>
        </div>

</div>