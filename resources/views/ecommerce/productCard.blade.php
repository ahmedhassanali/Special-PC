<div class="product-card">
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
                                id="Stroke-1">
                            </path>
                            <path d="M13.5,3.7 C14.57,4.046 15.326,5.001 15.417,6.122" id="Stroke-3"
                                opacity="0.400000006">
                            </path>
                        </g>
                    </g>
                </svg>
            </button>
        </form>
    @endif
    <a href="{{ route('ecommerce.product.show', $product->id) }}">
        <div class="swiper nestedSwiper">
            <div class="swiper-wrapper">
                @foreach ($product->images as $key => $image)
                   <div class="swiper-slide">
                        <img class="img-fluid" src="{{ asset($image->image) }}">
                    </div>
                 @endforeach
            </div>
            <div class="swiper-pagination swiper-pagination-v"></div>
        </div>

        <div class="details">
            <div class="labels">
                @if ($product->offer)
                    @if ($product->offer->type == App\Models\Offer::VALUE)
                        <small class="badge solid primary">{{ __('ecommerce.save_money') }}
                            {{ $product->offer->amount }} {{ __('ecommerce.currency') }}</small>
                    @else
                        <small class="badge solid primary">{{ __('ecommerce.save_money') }}
                            {{ $product->offer->amount }}%</small>
                    @endif
                @endif
                @if ($product->special_offer)
                    <small class="badge solid pink">{{ __('ecommerce.limited_quantity') }}</small>
                @endif
                @if ($product->free_shipping)
                    <small class="badge solid yellow">{{ __('ecommerce.free_shipping') }}</small>
                @endif
            </div>

            <div class="d-flex justify-content-between align-items-start">
                <h6 class="title-xs text-default">
                    {{ $product->name ?: (app()->getLocale() == 'ar' ? $product->ar_name : $product->en_name) ?: __('Product Name Not Available') }}
                </h6>

                <div class="price">
                    @if ($product->offer)
                        <del class="text-gray">
                            @if ($product->offer->type == App\Models\Offer::VALUE)
                                {{ $product->price - $product->offer->amount }}
                                {{ __('ecommerce.currency') }}
                            @else
                                {{ $product->price - ($product->offer->amount * $product->price) / 100 }}
                                {{ __('ecommerce.currency') }}
                            @endif
                        </del>
                    @endif
                    <p class="text-dark">
                        {{ $product->price }}
                    </p>
                    <!-- {{ __('ecommerce.currency') }} -->
                    <img width="15" src="{{ asset('assets/ecommerce/img/Saudi_Riyal_Symbol.svg') }}">
                </div>
                
            </div>
            @if ($product->color_id)
            <p class="text-default fs-12">اللون: 
            {{ $product->color_id ?  $product->color->name :  '' }}
            </p>
            @endif
            <p class="text-gray description">
                {{ $product->description ?: (app()->getLocale() == 'ar' ? strip_tags($product->ar_description) : strip_tags($product->en_description)) ?: __('Product description Not Available') }}
                </h6>
            </p>
        </div>
    </a>
    <div class="ppx-12">
        <form action="{{ route('ecommerce.cart.addItem') }}" method="POST" id="addToCartForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="1" name="quantity">
            <button class="btn btn-primary" type="button" onclick="submitAddToCart({{ $product->id }})">
                <svg id="Buy" width="20px" height="20px" viewBox="0 0 24 24" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Iconly/Two-tone/Buy" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                        stroke-linecap="round" stroke-linejoin="round">
                        <g id="Buy" transform="translate(2.000000, 2.500000)" stroke="#000000" stroke-width="1.5">
                            <path
                                d="M5.4223,17.3203 C5.8443,17.3203 6.1873,17.6633 6.1873,18.0853 C6.1873,18.5073 5.8443,18.8493 5.4223,18.8493 C5.0003,18.8493 4.6583,18.5073 4.6583,18.0853 C4.6583,17.6633 5.0003,17.3203 5.4223,17.3203 Z"
                                id="Stroke-1" opacity="0.400000006"></path>
                            <path
                                d="M16.6747,17.3203 C17.0967,17.3203 17.4397,17.6633 17.4397,18.0853 C17.4397,18.5073 17.0967,18.8493 16.6747,18.8493 C16.2527,18.8493 15.9097,18.5073 15.9097,18.0853 C15.9097,17.6633 16.2527,17.3203 16.6747,17.3203 Z"
                                id="Stroke-3" opacity="0.400000006"></path>
                            <path
                                d="M0.7499,0.75 L2.8299,1.11 L3.7929,12.583 C3.8709,13.518 4.6519,14.236 5.5899,14.236 L16.5019,14.236 C17.3979,14.236 18.1579,13.578 18.2869,12.69 L19.2359,6.132 C19.3529,5.323 18.7259,4.599 17.9089,4.599 L3.1639,4.599"
                                id="Stroke-5"></path>
                            <line x1="12.1254" y1="8.295" x2="14.8984" y2="8.295" id="Stroke-7"
                                opacity="0.400000006"></line>
                        </g>
                    </g>
                </svg>
                {{ __('ecommerce.add_to_cart') }}
            </button>
        </form>
    </div>
</div>
