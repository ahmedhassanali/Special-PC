@extends('ecommerce.layouts.app')
@section('content')
    @php
        if (Auth::guard('ecommerce')->check()) {
            $favorites = App\Models\Favorite::where('customer_id', Auth::guard('ecommerce')->user()->id)
                ->pluck('product_id')
                ->toArray();
        } else {
            $favorites = [];
        }
    @endphp
    <section class="page bg-light-blue">
        <div class="container">
            <h3 class="text-dark title-sm my-3">
                {{ __('ecommerce.favorites_title') }}
            </h3>
            <div class="row">
                @foreach ($processedFavorites as $product)
                    <div class="col-lg-3 col-md-4 col-6 col-xs-12">
                        @include('ecommerce.productCard', [
                            'product' => $product,
                            'favorites' => $favorites,
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
