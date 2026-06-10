@extends('ecommerce.layouts.app')
@section('content')
    <section class="profile bg-light-blue mt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-12">
                    <div class="bg-white">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="text-dark">
                                {{ __('ecommerce.order_details') }}
                            </h6>
                            <a class="link text-default" href="{{ route('ecommerce.profile') }}">
                                {{ __('ecommerce.back') }}
                                <svg id="Arrow - Left" width="20px" height="20px" viewBox="0 0 24 24" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Iconly/Light/Arrow---Left" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Arrow---Left"
                                            transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) translate(5.500000, 4.000000)"
                                            stroke="#717171" stroke-width="1.5">
                                            <line x1="6.7743" y1="15.75" x2="6.7743" y2="0.75"
                                                id="Stroke-1"></line>
                                            <polyline id="Stroke-3" points="12.7987 9.7002 6.7747 15.7502 0.7497 9.7002">
                                            </polyline>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </div>

                        <div class="bg-gray or-de">
                            <h6 class="text-default"> {{ __('ecommerce.order_number') }} #{{ $order->id }}</h6>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ __('ecommerce.products_count') }}
                                        </td>
                                        <td>
                                            {{ __('ecommerce.order_date') }}
                                        </td>
                                        <td>
                                            {{ __('ecommerce.total') }}
                                        </td>
                                        <td>
                                            {{ __('ecommerce.order_status') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ count($order->items) }} {{ __('ecommerce.products_count') }}
                                        </th>
                                        <th>
                                            {{ $order->created_at }}
                                        </th>
                                        <th>
                                            {{ $order->total }} {{ __('ecommerce.currency') }}
                                        </th>
                                        <th>
                                            <small
                                                class="badge
                                        @switch($order->status)
                                            @case(2)
                                                yellow
                                                @break
                                            @case(0)
                                                blue
                                                @break
                                            @case(3)
                                                green
                                                @break
                                            @case(4)
                                                purple
                                                @break
                                            @case(5)
                                                orange
                                                @break
                                            @case(6)
                                                red
                                                @break
                                            @case(7)
                                                gray
                                                @break
                                            @default
                                                default
                                        @endswitch
                                    ">
                                                @switch($order->status)
                                                    @case(2)
                                                    {{ __('ecommerce.processing') }}
                                                    @break

                                                    @case(0)
                                                    {{ __('ecommerce.preparing') }}
                                                    @break

                                                    @case(3)
                                                    {{ __('ecommerce.shipped') }}
                                                    @break

                                                    @case(4)
                                                    {{ __('ecommerce.delivered') }}
                                                    @break

                                                    @case(5)
                                                    {{ __('ecommerce.completed') }}
                                                    @break

                                                    @case(6)
                                                    {{ __('ecommerce.cancelled') }}
                                                    @break

                                                    @case(7)
                                                    {{ __('ecommerce.returned') }}
                                                    @break

                                                    @default
                                                    {{ __('ecommerce.unknown_status') }}
                                                @endswitch
                                            </small>
                                        </th>
                                    </tr>

                                </tbody>
                            </table>
                        </div>


                        @foreach ($order->items as $item)
                            <div class="order-card">
                                <div class="d-flex">
                                    <img class="img-fluid" src="{{ asset($item->product->image) }}">
                                    <div class="order-info m-2">
                                        <h6 class="text-dark">
                                            {{ $item->product->name }}
                                        </h6>
                                        <p class="text-default fs-14">
                                            {{ __('ecommerce.products_count') }}::
                                            {{ $item->quantity }}
                                        </p>
                                        <p class="text-default fs-14">
                                            {{ __('ecommerce.price') }}:
                                            {{ $item->itemPrice() }}
                                        </p>
                                    </div>
                                </div>
                                @php
                                    $createdAt = \Carbon\Carbon::parse($order->created_at);
                                    $now = \Carbon\Carbon::now();
                                    $daysPassed = $now->diffInDays($createdAt);
                                @endphp
                                @if ($order->status == 7 && $daysPassed > 14)
                                    <small class="text text-red">
                                        {{ __('ecommerce.expired_return') }}
                                    </small>
                                @else
                                    <a class="text link text-success">
                                        {{ __('ecommerce.return_product') }}
                                    </a>
                                @endif
                            </div>
                        @endforeach

                        <div class="row gx-0">
                            <div class="col-md-6 col-12">
                                <div class="bordered">
                                    <h6 class="text-default mb-2">{{ __('ecommerce.payment_details') }}</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>
                                                {{ __('ecommerce.payment_method') }}
                                            </td>
                                            <th>
                                                @if ( isset($order->payment) && $order->payment->payment_method == 'Card')
                                                {{ __('ecommerce.card') }}
                                                @elseif( isset($order->payment) && $order->payment->payment_method == 'Wallet')
                                                {{ __('ecommerce.wallet') }}
                                                @else
                                                {{ __('ecommerce.cash_on_delivery') }}
                                                @endif
                                            </th>
                                        </tr>

                                        <tr>
                                            <td>
                                                {{ __('ecommerce.payment_details_total') }}
                                            </td>
                                            <th>
                                                {{ __('ecommerce.total') }}:
                                                {{ $order->total }} {{ __('ecommerce.currency') }}
                                            </th>
                                        </tr>

                                        <tr>
                                            <td>
                                                {{ __('ecommerce.shipping_fees') }}: {{ $order->shipping_fees }} {{ __('ecommerce.currency') }}
                                            </td>
                                            <th>
                                                {{ __('ecommerce.total') }}:
                                                {{ $order->shipping_fees + $order->total }} {{ __('ecommerce.currency') }}
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="bordered">
                                    <h6 class="text-default mb-2">{{ __('ecommerce.delivery_details') }}</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>
                                                {{ __('ecommerce.delivery_method') }}
                                            </td>
                                            <th>
                                                {{ __('ecommerce.home_delivery') }}
                                            </th>
                                        </tr>

                                        <tr>
                                            <td>
                                                {{ __('ecommerce.delivery_address') }}
                                            </td>
                                            <th>
                                                {{ $order->address->city->name }} / {{ $order->address->area->name }} /
                                                {{ $order->address->address }}
                                            </th>
                                        </tr>

                                        <tr>
                                            <td>
                                                {{ __('ecommerce.shipping_details') }}
                                            </td>
                                            <th>
                                                {{ __('ecommerce.delivery_date') }}
                                                {{ $order->customer_receiving_time }}
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
