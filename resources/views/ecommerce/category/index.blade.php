@extends('ecommerce.layouts.app')
 
@section('content')
    <section class="category page bg-light-blue">
        <div class="container">
            <div class="row-wrapper mb-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">
                            {{ __('ecommerce.home') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}
                        </li>
                    </ol>
                </nav>
                <p class="btn btn-sm btn-secondary d-lg-none d-block show-filter">
                        تصفية النتائج
                </p>
                @include('ecommerce.category.sections.arrange')
            </div>
        </div>

        <div class="container">
            @include('ecommerce.category.sections.filter')
            <div class="row">
                @php
                    if (Auth::guard('ecommerce')->check()) {
                        $favorites = App\Models\Favorite::where('customer_id', Auth::guard('ecommerce')->user()->id)
                            ->pluck('product_id')
                            ->toArray();
                    } else {
                        $favorites = [];
                    }
                @endphp

                @if (count($filteredProducts))
                @foreach ($filteredProducts as $product)
                    <div class="col-lg-3 col-md-4 col-6 col-xs-12">
                        @include('ecommerce.productCard', ['product' => $product , 'favorites' => $favorites])
                    </div>
                @endforeach
                @else
                    <div class="no-items"></div>
                @endif
            </div>
        </div>
        
    </section>

@endsection
