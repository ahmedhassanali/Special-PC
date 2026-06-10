@extends('ecommerce.layouts.app')
@section('content')
@php
use Illuminate\Support\Str;
@endphp
    <section class="product page bg-light-blue">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">
                        {{ __('ecommerce.home') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="category.html">
                            {{ $product->category ? $product->category->name : '-' }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{$product->subCategory ? $product->subCategory->name : '-' }}
                    </li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-7 col-md-6">
                    <div class="slides row">
                        <div class="col-md-2 col-sm-3 more-img">
                            @foreach ($product->images as $key => $image)
                                <div>
                                    <img class="preview small-img" style="width:100%" src="{{ asset($image) }}"
                                        onclick="toggleVisibility({{ $key }})">
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-10 col-sm-9">
                            @foreach ($product->images as $key => $image)
                                <img class="productSlides img-fluid main-img"
                                    @if ($key != 0) style="display:none" @endif src="{{ asset($image) }}">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="product-description">
                        <!-- name and share -->
                        <div class="d-flex align-items-start">
                            <h4 class="text-dark w-90">
                            {{ $product->name ?: (app()->getLocale() == 'ar' ? $product->ar_name : $product->en_name) ?: __('Product Name Not Available') }}
                            </h4>
                            <button class="fav-circle text-gray" id="ShareButton">
                                <svg id="Send" width="20px" height="20px" viewBox="0 0 24 24" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Iconly/Two-tone/Send" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Send" transform="translate(2.500000, 2.500000)" stroke="#000000"
                                            stroke-width="1.5">
                                            <line x1="13.2120035" y1="5.22669668" x2="7.39100352" y2="11.0476967"
                                                id="Stroke-1" opacity="0.400000006"></line>
                                            <path
                                                d="M7.39120352,11.0479967 L0.576203525,6.88099668 C-0.316796475,6.33499668 -0.135796475,4.98799668 0.870203525,4.69699668 L16.9602035,0.0489966826 C17.8752035,-0.216003317 18.7212035,0.637996683 18.4472035,1.54999668 L13.6732035,17.5139967 C13.3742035,18.5139967 12.0332035,18.6859967 11.4912035,17.7939967 L7.39120352,11.0479967"
                                                id="Stroke-3"></path>
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </div>
                        <!-- Rating -->
                        <div class="d-flex align-items-center">
                            <div class="rating">
                                <ul class="list-inline">
                                    @for ($i = 1; $i <= 5; $i++)
                                    @if ($product->ratingCount == 0)
                                       <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                    @else
                                        @if ($i <= $product->rate)
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                        @else
                                            <li class="list-inline-item m-0"><i class="far fa-star text-warning"></i></li>
                                        @endif
                                    @endif
                                    @endfor
                                </ul>
                            </div>
                            <small>
                                (+{{ $product->ratingCount > 0 ? $product->ratingCount : 1 }} {{ __('ecommerce.users') }})
                            </small>


                        </div>

                        <!-- labels -->
                        <div class="labels">
                            @if ($product->offer)
                                @if ($product->offer->type == App\Models\Offer::VALUE)
                                    <small class="badge solid primary">{{ __('ecommerce.save_money') }} {{ $product->offer->amount }} {{ __('ecommerce.currency') }}</small>
                                @else
                                    <small class="badge solid primary">{{ __('ecommerce.save_money') }} {{ $product->offer->amount }}%</small>
                                @endif
                            @endif
                            @if ($product->free_shipping)
                                <small class="badge solid yellow">
                                    {{ __('ecommerce.free_shipping') }}
                                </small>
                            @endif
                            @if ($product->special_offer)
                                <small class="badge solid pink">
                                    {{ __('ecommerce.limited_quantity') }}
                                </small>
                            @endif
                        </div>
                        <!-- price , old price -->
                        <div class="price d-flex g-6">
                            <h6 class="title-sm text-dark">
                                {{ $product->price }}
                            </h6>
                            <img width="22" src="{{ asset('assets/ecommerce/img/Saudi_Riyal_Symbol.svg') }}">

                            @if ($product->offer)
                                <del class="text-gray">
                                    @if ($product->offer->type == App\Models\Offer::VALUE)
                                        {{ $product->price - $product->offer->amount }} ريال
                                    @else
                                        {{ $product->price - ($product->offer->amount * $product->price) / 100 }} ريال
                                    @endif
                                </del>
                            @endif

                        </div>
                        @if ($product->color_id)
                        <p class="text-default fs-12">اللون:
                            {{ $product->color_id ?  $product->color->name :  '' }}
                            </p>
                            @endif
                        <div class="d-flex align-items-start">
                            <h5 class="text-dark w-90">
                                {{ Str::limit(strip_tags($product->description), 150) }}
                            </h5>
                        </div>

                        @php
                            if (Auth::guard('ecommerce')->check()) {
                                $favorites = App\Models\Favorite::where('customer_id', Auth::guard('ecommerce')->user()->id)
                                    ->pluck('product_id')
                                    ->toArray();
                            } else {
                                $favorites = [];
                            }
                        @endphp
                        <!-- buy , add to favs -->
                        <div class="buttons mt-auto">

                            @if (Auth::guard('ecommerce')->check())
                                <form class="favoriteForm" action="{{ route('ecommerce.client.favorite') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <input type="hidden" value="{{ Auth::guard('ecommerce')->user()->id }}" name="customer_id">
                                <button class="favoriteButton fav-circle text-gray {{ in_array($product->id, $favorites) ? 'active' : '' }}"
                                    type="button" onclick="submitFavorite(this, '{{ $product->id }}')">
                                    <svg id="Heart" width="20px" height="20px" viewBox="0 0 24 24" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Iconly/Two-tone/Heart" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <g id="Heart" transform="translate(2.500000, 3.000000)" stroke="#000000" stroke-width="1.5">
                                                <path
                                                    d="M0.371865331,8.59832177 C-0.701134669,5.24832177 0.552865331,1.41932177 4.06986533,0.28632177 C5.91986533,-0.31067823 7.96186533,0.0413217701 9.49986533,1.19832177 C10.9548653,0.0733217701 13.0718653,-0.30667823 14.9198653,0.28632177 C18.4368653,1.41932177 19.6988653,5.24832177 18.6268653,8.59832177 C16.9568653,13.9083218 9.49986533,17.9983218 9.49986533,17.9983218 C9.49986533,17.9983218 2.09786533,13.9703218 0.371865331,8.59832177 Z"
                                                    id="Stroke-1"></path>
                                                <path d="M13.5,3.7 C14.57,4.046 15.326,5.001 15.417,6.122" id="Stroke-3"
                                                    opacity="0.400000006"></path>
                                            </g>
                                        </g>
                                    </svg>
                                </button>
                            </form>
                            @endif


                            <form action="{{ route('ecommerce.cart.addItem') }}" id="addToCartForm" method="POST" class="col-12"
                                enctype="multipart/form-data">
                                @csrf
                                <input hidden value="1" name="quantity">
                                <button class="btn btn-primary btn-lg w-90" type="button" onclick="submitAddToCart({{ $product->id }})">
                                    <svg id="Buy" width="20px" height="20px" viewBox="0 0 24 24"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Iconly/Two-tone/Buy" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="Buy" transform="translate(2.000000, 2.500000)" stroke="#000000"
                                                stroke-width="1.5">
                                                <path
                                                    d="M5.4223,17.3203 C5.8443,17.3203 6.1873,17.6633 6.1873,18.0853 C6.1873,18.5073 5.8443,18.8493 5.4223,18.8493 C5.0003,18.8493 4.6583,18.5073 4.6583,18.0853 C4.6583,17.6633 5.0003,17.3203 5.4223,17.3203 Z"
                                                    id="Stroke-1" opacity="0.400000006"></path>
                                                <path
                                                    d="M16.6747,17.3203 C17.0967,17.3203 17.4397,17.6633 17.4397,18.0853 C17.4397,18.5073 17.0967,18.8493 16.6747,18.8493 C16.2527,18.8493 15.9097,18.5073 15.9097,18.0853 C15.9097,17.6633 16.2527,17.3203 16.6747,17.3203 Z"
                                                    id="Stroke-3" opacity="0.400000006"></path>
                                                <path
                                                    d="M0.7499,0.75 L2.8299,1.11 L3.7929,12.583 C3.8709,13.518 4.6519,14.236 5.5899,14.236 L16.5019,14.236 C17.3979,14.236 18.1579,13.578 18.2869,12.69 L19.2359,6.132 C19.3529,5.323 18.7259,4.599 17.9089,4.599 L3.1639,4.599"
                                                    id="Stroke-5"></path>
                                                <line x1="12.1254" y1="8.295" x2="14.8984" y2="8.295"
                                                    id="Stroke-7" opacity="0.400000006"></line>
                                            </g>
                                        </g>
                                    </svg>
                                    {{ __('ecommerce.add_to_cart') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rev-pro">
                <div class="d-flex bg-gray">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="props" data-bs-toggle="list"
                            href="#list-props" role="tab" aria-controls="list-props">
                            {{ __('ecommerce.specifications') }}
                        </a>
                        <a class="list-group-item list-group-item-action" id="reviews" data-bs-toggle="list"
                            href="#list-reviews" role="tab" aria-controls="list-reviews">
                            {{ __('ecommerce.reviews_and_ratings') }}
                        </a>
                    </div>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-props" role="tabpanel" aria-labelledby="list-props">
                        <ul class="text-default p-3">
                            <li>
                                {!! $product->description !!}
                            </li>
                        </ul>
                    </div>

                    <div class="tab-pane fade" id="list-reviews" role="tabpanel" aria-labelledby="reviews">
                        <div class="p-3">
                            <p class="text-dark">
                                {{ __('ecommerce.overall_rating') }}
                            </p>
                            <div class="d-flex align-items-center g-10">
                                <h2 class="text-dark">{{ $product->rate }}</h2>
                                <div class="rating">
                                    <ul class="list-inline">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $product->rate)
                                                <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                                </li>
                                            @else
                                                <li class="list-inline-item m-0"><i class="far fa-star text-warning"></i>
                                                </li>
                                            @endif
                                        @endfor
                                    </ul>
                                </div>
                                <small>
                                    (+{{ $product->ratingCount }} {{ __('ecommerce.users') }})
                                </small>
                            </div>

                            <p class="text-dark mt-3">
                                {{ __('ecommerce.reviews_and_ratings') }}
                            </p>
                            <div class="reviews">

                                @foreach ($product->feedbacks as $feedback)
                                    <div class="rev-box">
                                        <img class="img-fluid" src="{{ asset($feedback->image) }}">
                                        <div class="d-column">
                                            <div class="rating">
                                                <ul class="list-inline">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $feedback->rating)
                                                            <li class="list-inline-item m-0"><i
                                                                    class="fas fa-star text-warning"></i></li>
                                                        @else
                                                            <li class="list-inline-item m-0"><i
                                                                    class="far fa-star text-warning"></i></li>
                                                        @endif
                                                    @endfor
                                                </ul>
                                            </div>
                                            <p class="text-dark">
                                                {{ $feedback->feedback }}
                                            </p>
                                            <small class="text-gray">
                                                {{ $feedback->name }}
                                            </small>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="products">
            <div class="container">
                <h2 class="title-md text-dark mb-3">{{ __('ecommerce.may_like') }}</h2>
                <div class="swiper productSwiper">
                    <div class="swiper-wrapper">
                        @php
                            if (Auth::guard('ecommerce')->check()) {
                                $favorites = App\Models\Favorite::where(
                                    'customer_id',
                                    Auth::guard('ecommerce')->user()->id,
                                )
                                    ->pluck('product_id')
                                    ->toArray();
                            } else {
                                $favorites = [];
                            }
                        @endphp
                        @foreach ($product->category->product as $product)
                            <div class="swiper-slide">
                                @include('ecommerce.productCard', ['product' => $product , 'favorites' => $favorites])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
