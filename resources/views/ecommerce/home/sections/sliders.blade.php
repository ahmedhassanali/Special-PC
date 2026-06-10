<section class="offers-swiper">
    <div class="container-lg">
        <!-- Swiper -->
        <div class="swiper offersSwiper">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                <div class="swiper-slide">
                    <a href="{{ $slider->product_id ?  route('ecommerce.product.show', $slider->product_id) : '' }}">
                        <img class="img-fluid" src="{{ asset($slider->image)}}">
                    </a>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
