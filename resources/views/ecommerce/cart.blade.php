@extends('ecommerce.layouts.app')

@section('content')
    <section class="cart page bg-light-blue" id="payment">
        <div class="container">
            <div class="">
                <h3 class="text-dark title-sm my-3">
                    {{ __('ecommerce.cart_title') }}
                </h3>
                @if (count($items) > 0)
                    <div class="row">
                        <div class="col-md-8 col-12">

                            @php
                                $total = 0;
                                $quantity = 0;
                            @endphp

                            @foreach ($items as $item)
                                <div class="order-card">
                                    @php
                                        $quantity += $item->quantity;
                                        $price = $item->cartItemPrice();
                                        $total += $price;
                                    @endphp
                                    <div class="d-flex">

                                        @php
                                            $favorites = App\Models\Favorite::where(
                                                'customer_id',
                                                Auth::guard('ecommerce')->user()->id,
                                            )
                                                ->pluck('product_id')
                                                ->toArray();
                                        @endphp
                                    <form class="favoriteForm" action="{{ route('ecommerce.client.favorite') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $item->product->id }}" name="product_id">
                                        <input type="hidden" value="{{ Auth::guard('ecommerce')->user()->id }}" name="customer_id">
                                        <button class="favoriteButton fav-circle text-gray {{ in_array($item->product->id, $favorites) ? 'active' : '' }}" type="button" onclick="submitFavorite(this, '{{ $item->product->id }}')">
                                            <svg id="Heart" width="20px" height="20px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g id="Iconly/Two-tone/Heart" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                                    <g id="Heart" transform="translate(2.500000, 3.000000)" stroke="#000000" stroke-width="1.5">
                                                        <path d="M0.371865331,8.59832177 C-0.701134669,5.24832177 0.552865331,1.41932177 4.06986533,0.28632177 C5.91986533,-0.31067823 7.96186533,0.0413217701 9.49986533,1.19832177 C10.9548653,0.0733217701 13.0718653,-0.30667823 14.9198653,0.28632177 C18.4368653,1.41932177 19.6988653,5.24832177 18.6268653,8.59832177 C16.9568653,13.9083218 9.49986533,17.9983218 9.49986533,17.9983218 C9.49986533,17.9983218 2.09786533,13.9703218 0.371865331,8.59832177 Z" id="Stroke-1"></path>
                                                        <path d="M13.5,3.7 C14.57,4.046 15.326,5.001 15.417,6.122" id="Stroke-3" opacity="0.400000006"></path>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </form>

                                        <a href="{{ route('ecommerce.product.show', $item->product->id) }}">
                                            <img loading="lazy" class="img-fluid" src="{{ asset($item->product->image) }}">
                                        </a>
                                        <div class="order-info mx-2">
                                            <h6 class="text-dark">
                                                {{ $item->product->name }}
                                            </h6>
                                            <p class="text-default fs-14">
                                                {{ __('ecommerce.product_description') }}:
                                                {{ \Illuminate\Support\Str::limit(strip_tags($item->product->description), 100) }}
                                                </p>

                                            <div class="plus-minus-input">
                                                <p class="text-default m-2">{{ __('ecommerce.quantity') }}</p>

                                                <form action="{{ route('ecommerce.cart.updateItemQuantity', $item->id) }}" id="quantityForm"
                                                method="POST" enctype="multipart/form-data" class="row mx-2">
                                                @csrf
                                                    <button type="button" class="button plus-button" data-quantity="plus" data-field="quantity">
                                                        +
                                                    </button>

                                                    <input class="input-group-field quantity-input"type="number"
                                                        id="quantity-input-{{ $item->id }}"
                                                        name="quantity"
                                                        max="{{ $item->product->stock }}"
                                                        value="{{ $item->quantity }}">

                                                    <input class="input-group-field product-input" hidden type="number" id="input-{{ $item->id }}" name="product_id"  value="{{ $item->id }}">

                                                    <button type="button" class="button minus-button" data-quantity="minus" data-field="quantity">
                                                        -
                                                    </button>

                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="d-column justify-content-between align-items-end">
                                        <a class="text text-red delete-btn"
                                            href="{{ route('ecommerce.cart.removeItem', $item->id) }}">{{ __('ecommerce.delete') }}</a>
                                        <div class="price">
                                        <h5 class="text-dark item-price" id="item-price-{{ $item->id }}">{{ number_format($price, 2) }} {{ __('ecommerce.currency') }}</h5>
                                        </div>
                                    </div>

                                </div>
                            @endforeach

                        </div>
                        <div class="col-md-4 col-12">
                            <div class="recpit">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ __('ecommerce.products_total') }}  (<span id="total-quantity">{{ $quantity }}</span> {{ __('ecommerce.products') }})
                                            </td>
                                            <th>
                                                <span id="total-price">{{ $total }}</span>  {{ __('ecommerce.currency') }}
                                            </th>
                                        </tr>

                                        <tr>
                                            <td>
                                                {{ __('ecommerce.shipping_fees') }}
                                            </td>
                                            <th>
                                                @php
                                                    $delivery_fees = Auth::guard('ecommerce')->user()->defaultAddress() ? Auth::guard('ecommerce')->user()->defaultAddress()->area->delivery_fees : 0;
                                                    $total += $delivery_fees;
                                                @endphp
                                                    {{ $delivery_fees }} {{ __('ecommerce.currency') }}
                                            </th>
                                        </tr>

                                        <tr>
                                            <td>
                                                {{ __('ecommerce.total') }}
                                            </td>
                                            <th id="order-price">
                                                    @if (isset($settings->tax))
                                                        {{ number_format($total + $total * ($settings->tax / 100), 2) }} ريال
                                                    @else
                                                        {{ number_format($total, 2) }} {{ __('ecommerce.currency') }}
                                                    @endif

                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <a type="submit" href="{{ route('ecommerce.order') }}"
                                    class="btn btn-primary w-100 my-3">{{ __('ecommerce.continue') }}</a>

                                <div class="d-flex g-4 align-items-center mt-2">
                                    <img src="{{ asset('assets/ecommerce/img/return.png') }}" width="16px">
                                    <p class="text-default">
                                        {{ __('ecommerce.free_return_days', ['days' => 10]) }}
                                    </p>
                                </div>
                                <div class="d-flex g-4 align-items-center mt-2">
                                    <img src= "{{ asset('assets/ecommerce/img/safe.png') }}" width="16px">
                                    <p class="text-default">
                                        {{ __('ecommerce.one_year_warranty') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="no-items"></div>
                @endif
            </div>
    </section>
@endsection
