@php
    if (Auth::guard('ecommerce')->check()) {
        $favorites = App\Models\Favorite::where('customer_id', Auth::guard('ecommerce')->user()->id)
            ->pluck('product_id')
            ->toArray();
    } else {
        $favorites = [];
    }
@endphp
<div class="swiper productSwiper">
    <div class="swiper-wrapper">
        @foreach ($products as $product)
            <div class="swiper-slide">
                @include('ecommerce.productCard', ['product' => $product , 'favorites' => $favorites])
            </div>
        @endforeach
    </div>
</div>
