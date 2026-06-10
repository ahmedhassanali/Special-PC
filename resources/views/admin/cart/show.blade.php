@extends('admin.layouts.admin')

@section('content')
<div class="page-content-wrapper m-3">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between">
            <h4>
                سلة العميل
            </h4>
        </div>
    </div>

    <div class="card-body">
            @php
                                $total = 0;
                                $quantity = 0;
                                @endphp
                            @foreach ($carts as $cart)

                                   <div class="">
                                            @foreach ($cart->items as $item)
                                            @php
                                                $quantity += $item->quantity;
                                                $price = $item->cartItemPrice();
                                                $total += $price;
                                            @endphp
                                                <div class="cart-item order-card">
                                                    <div class="item-image">
                                                        <img class="img-fluid small-image" src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}">
                                                    </div>
                                                    <div class="item-details">
                                                        <h6 class="item-name">{{ $item->name }}
                                                          أسم المنتج يظهر هنا
                                                        </h6>
                                                        <div class="item-price">
                                                            <p>{{ number_format($price, 2) }} {{ __('ecommerce.currency') }}</p>
                                                        </div>
                                                    </div>    
                                                </div>
                                            @endforeach

                                    </div>

                            @endforeach

                            
    </div>
</div>
@endsection




