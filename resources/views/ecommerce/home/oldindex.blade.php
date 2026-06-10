@extends('ecommerce.layouts.app')

@section('content')
    @include('ecommerce.home.sections.sliders')

    @include('ecommerce.home.sections.categories')
    <main class="home">
        <section class="flash-sale products">
            <div class="container">
                <h2 class="title-md text-primary mb-3">{{ __('ecommerce.flash_sale_title') }}</h2>
                @include('ecommerce.home.sections.products', ['products' => $specialOfferProducts])
            </div>
        </section>

        @include('ecommerce.home.sections.offers')

        <section class="products">
            <div class="container">
                <h2 class="title-md text-pink mb-3">{{ __('ecommerce.best_selling_title') }}</h2>
                @include('ecommerce.home.sections.products', ['products' => $mostSellingProducts])

            </div>
        </section>

        <section class="products">
            <div class="container">
                <h2 class="title-md text-dark mb-3">{{ __('ecommerce.free_shipping_title') }}</h2>
                @include('ecommerce.home.sections.products', ['products' => $freeShippingProducts])
            </div>
        </section>
    </main>
@endsection
