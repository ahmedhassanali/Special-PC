@extends('ecommerce.layouts.app')

@section('content')
    <section class="cart page bg-light-blue" id="payment">
        <div class="container">
            <div class="">
                <br>
                <div class="row">

                    <div class="col-md-8 col-12">

                        @include('ecommerce.layouts.errors')
                        <div class="d-flex justify-content-between my-2">
                            <h5 class="text-default">{{ __('ecommerce.select_address') }}</h5>

                            <a class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#addAddress">
                                +
                                {{ __('ecommerce.add_address') }}
                            </a>
                        </div>

                        @if (count($addresses) > 0)
                            @foreach ($addresses as $address)
                                <div class="address-card my-2">

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="{{ $address->id }}"
                                            id="customer_address_id_radio" name="customer_address_id_radio"
                                            id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            <h6 class="text-default">
                                                {{ $address->title }}
                                            </h6>
                                        </label>
                                    </div>
                                    <p class="text-default">{{ $address->city->ar_name }} - {{ $address->area->ar_name }}
                                    </p>
                                    <div class="d-flex align-items-center justify-content-between">

                                        <p class="text-default">{{ $address->address }}</p>
                                        <div class="d-flex g-10">
                                            <a class="link text-red"
                                                href="{{ route('customer.address.destroy', $address->id) }}" id="delete-btn">
                                                {{ __('ecommerce.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <br>
                        <div class="d-flex justify-content-between my-2">
                            <h5 class="text-default">{{ __('ecommerce.select_payment_method') }}</h5>
                            <a class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#add-card">
                                +{{ __('ecommerce.add_card') }}
                            </a>
                        </div>
                        <div class="ways">
                            <div class="coll">
                                <div class="likerow" id="visa-section">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="card"
                                            id="payment_type_radio" name="payment_type_radio" id="flexRadioDefault2"
                                            checked>
                                        <h6 class="text-default">{{ __('ecommerce.credit_card_payment') }}</h6>
                                    </div>
                                    <img class="img-fluid" src="{{ asset('assets/ecommerce/img/cards.png') }}">
                                </div>

                                <div class="method visa" id="visa">
                                    <p class="text-default">
                                        {{ __('ecommerce.enter_card_details') }}
                                    </p>
                                </div>
                            </div>

                            <div class="coll">
                                <div class="likerow" id="cash-section">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="cash"
                                            id="payment_type_radio" name="payment_type_radio" id="flexRadioDefault2"
                                            checked>
                                        <h6 class="text-default">{{ __('ecommerce.cash_on_delivery') }}</h6>
                                    </div>
                                    <span class="text-primary">{{ __('ecommerce.verification_required') }}</span>
                                </div>
                            </div>

                            <div class="coll">
                                <div class="likerow" id="cash-section">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="wallet"
                                            id="payment_type_radio" name="payment_type_radio" id="flexRadioDefault2"
                                            checked>
                                        <h6 class="text-default">{{ __('ecommerce.wallet_payment') }}</h6>
                                    </div>
                                    <p class="text-dark">{{ __('ecommerce.wallet_balance') }}: {{ Auth::guard('ecommerce')->user()->wallet }} {{ __('ecommerce.currency') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="recpit">
                            <h5 class="text-default">{{ __('ecommerce.order_summary') }}</h5>
                            <div class="d-column g-4">
                                @php
                                    $total = 0;
                                    $quantity = 0;
                                @endphp
                                @foreach ($items as $item)
                                    @php
                                        $quantity += $item->quantity;
                                        $price = $item->cartItemPrice();
                                        $total += $price;
                                    @endphp
                                    <p class="my-2">
                                        {{ $item->product->name }} / {{ __('ecommerce.quantity') }} : {{ $item->quantity }} / {{ __('ecommerce.price') }} :
                                        {{ $price }}
                                    </p>
                                @endforeach
                            </div>

                            <hr class="dashed">
                            <div class="m-2 d-flex row">
                                <label class="text-default col-12">{{ __('ecommerce.have_discount_code') }}</label>
                                <div class="col-md-12 mt-2">
                                    <form class="row" action="{{ route('customer.coupon.check') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-8">
                                            <input class="form-control" name="coupon_input" id="coupon_input" type="text"
                                                placeholder="xxxxxx">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary w-100">{{ __('ecommerce.apply') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <hr>

                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ __('ecommerce.total_including_tax') }}
                                        </td>
                                        <th>
                                            @if (isset($settings->tax))
                                                {{ $total + $total * ($settings->tax / 100) }} {{ __('ecommerce.currency') }}
                                            @else
                                                {{ $total }} {{ __('ecommerce.currency') }}
                                            @endif

                                        </th>
                                    </tr>

                                    <tr>
                                        @php
                                            $couponAmount = 0;
                                        @endphp
                                        @if (session()->has('coupon'))
                                            <td>{{ __('ecommerce.coupon_value') }}</td>
                                            <th>
                                                @if (session('coupon')->type == 2)
                                                    {{ $total * (session('coupon')->amount / 100) }} {{ __('ecommerce.currency') }}
                                                @else
                                                    {{ session('coupon')->amount }} {{ __('ecommerce.currency') }}
                                                @endif
                                                @php
                                                    $couponAmount =
                                                        session('coupon')->type == 2
                                                            ? $total * (session('coupon')->amount / 100)
                                                            : session('coupon')->amount;
                                                @endphp
                                            </th>
                                        @endif
                                    </tr>

                                    <tr>
                                        @if (session()->has('coupon'))
                                            <td>
                                                {{ __('ecommerce.total_after_coupon') }}
                                            </td>
                                            <th>
                                                @if (session('coupon')->type == 2)
                                                    {{ $total -= $total * (session('coupon')->amount / 100) }} ريال
                                                @else
                                                    {{ $total -= session('coupon')->amount }} ريال
                                                @endif
                                            </th>
                                        @endif
                                    </tr>

                                    <tr>
                                        <td>
                                            {{ __('ecommerce.shipping_fees') }}
                                        </td>
                                        <th>
                                            @php
                                                $delivery_fees = Auth::guard('ecommerce')->user()->defaultAddress() ?
                                                Auth::guard('ecommerce')->user()->defaultAddress()->area->delivery_fees : 0;
                                            @endphp
                                            {{ $delivery_fees }} {{ __('ecommerce.currency') }}
                                        </th>
                                    </tr>

                                    <tr>
                                        <td>
                                            {{ __('ecommerce.total_amount') }}
                                        </td>
                                        <th>
                                            {{ $total += $delivery_fees }} {{ __('ecommerce.currency') }}
                                        </th>
                                    </tr>

                                </tbody>
                            </table>


                            <form class="row" action="{{ route('customer.order.store') }}" method="POST"
                                id="addOrderForm" enctype="multipart/form-data">
                                @csrf
                                <input hidden name="customer_address_id" id="customer_address_id">
                                <input hidden name="coupon" id="coupon_id">
                                <input hidden name="customer_id" id="customer_id" value="{{ Auth::guard('ecommerce')->user()->id}}">
                                <input hidden name="payment_type" id="payment_type">
                                <input type="hidden" name="ref" value="{{ request()->query('ref') }}">
                                <input hidden name="couponAmount" value="{{ $couponAmount }}">
                                <button type="submit" class="btn btn-primary w-100 mt-2">{{ __('ecommerce.complete_order') }}</button>
                            </form>
                        </div>
                        <a class="link text-default" href=" {{ route('ecommerce.cart.show') }} " id="prevBtn">
                            {{ __('ecommerce.return') }}
                        </a>
                    </div>
                </div>
            </div>

    </section>

    <!-- Modal -->
    <div class="modal fade success" id="orderSuccess" tabindex="-1" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <img class="img-fluid" src="{{ asset('assets/ecommerce/img/success.png') }}">
                    <h4 class="title-sm text-dark text-center" id="successModalLabel">
                        {{ __('ecommerce.order_completed_successfully') }}
                    </h4>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <p class="text-center text-default">
                        {{ __('ecommerce.track_order_through_orders_list') }}
                    </p>
                </div>
                <a type="button" href="{{ route('home') }}" class="btn btn-primary">{{ __('ecommerce.continue_shopping') }}</a>
            </div>
        </div>
    </div>

    @include('ecommerce.profile.models.add-address')
    @include('ecommerce.profile.models.add-card')
@endsection


@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
    // Function to get the checked payment method
    function getCheckedPaymentMethod() {
        const selectedPayment = document.querySelector('input[name="payment_type_radio"]:checked');
        if (selectedPayment) {
             if (selectedPayment.value == 'card') {
                $('#addOrderForm').attr('action', "{{route('charge')}}");
                $('#addOrderForm').attr('method', "GET");
            } else {
                $('#addOrderForm').attr('action',"{{ route('customer.order.store') }}");
                $('#addOrderForm').attr('method', "POST");
             }
        } else {
            console.log("No payment method selected");
        }
    }

    // Get all the radio buttons
    const paymentRadios = document.querySelectorAll('input[name="payment_type_radio"]');

    // Add event listeners to each radio button
    paymentRadios.forEach(radio => {
        radio.addEventListener('change', getCheckedPaymentMethod);
    });

    // Check the initially selected payment method
    getCheckedPaymentMethod();
});

  </script>
@endsection