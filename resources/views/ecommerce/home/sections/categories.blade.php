<section id="categories" class="categories">
    <div class="container-lg">
        <div class="row">
            @if (isset($categories[0]))
            <div class="col-lg-3 col-md-4 col-sm-5 col-5">
                <div class="category-card main">
                    <a href="{{ route('ecommerce.category.show' , $categories[0]->id) }}">
                        <img loading="lazy" class="img-fluid"
                            src="{{ asset($categories[0]->image)}}">
                        <div class="details">
                            <h5 class="text-white">{{ app()->getLocale() == 'ar'  ? $categories[0]->ar_title :  $categories[0]->en_title }}</h5>
                            <small class="text-primary">
                                {{ __('ecommerce.details') }}
                                <svg id="Arrow - Left" width="16px" height="16px" viewBox="0 0 24 24"
                                    version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Iconly/Light/Arrow---Left" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Arrow---Left"
                                            transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) translate(5.500000, 4.000000)"
                                            stroke="#000000" stroke-width="1.6">
                                            <line x1="6.7743" y1="15.75" x2="6.7743" y2="0.75" id="Stroke-1">
                                            </line>
                                            <polyline id="Stroke-3"
                                                points="12.7987 9.7002 6.7747 15.7502 0.7497 9.7002"></polyline>
                                        </g>
                                    </g>
                                </svg>
                            </small>
                        </div>
                    </a>
                </div>
            </div>
            @endif
            <div class="col-lg-9 col-md-8 col-sm-7 col-7 p-0 row">
                @if (isset($categories[1]))
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="category-card">
                        <a href="{{ route('ecommerce.category.show' , $categories[1]->id) }}">
                            <img loading="lazy" class="img-fluid"
                                src="{{ asset($categories[1]->image)}}">
                            <div class="details">
                                <h5 class="text-white">{{ app()->getLocale() == 'ar'  ? $categories[1]->ar_title :  $categories[1]->en_title }}</h5>
                                <small class="text-primary">
                                    {{ __('ecommerce.details') }}
                                    <svg id="Arrow - Left" width="16px" height="16px" viewBox="0 0 24 24"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Iconly/Light/Arrow---Left" stroke="none" stroke-width="1"
                                            fill="none" fill-rule="evenodd" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <g id="Arrow---Left"
                                                transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) translate(5.500000, 4.000000)"
                                                stroke="#000000" stroke-width="1.6">
                                                <line x1="6.7743" y1="15.75" x2="6.7743" y2="0.75"
                                                    id="Stroke-1">
                                                </line>
                                                <polyline id="Stroke-3"
                                                    points="12.7987 9.7002 6.7747 15.7502 0.7497 9.7002">
                                                </polyline>
                                            </g>
                                        </g>
                                    </svg>
                                </small>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if (isset($categories[2]))
                <div class="col-lg-4 col-md-5 col-6 ppl-4">
                    <div class="category-card">
                        <a href="{{ route('ecommerce.category.show' , $categories[2]->id) }}">
                            <img loading="lazy" class="img-fluid" src="{{ asset($categories[2]->image)}}">
                            <div class="details">
                                <h5 class="text-white">{{ app()->getLocale() == 'ar'  ? $categories[2]->ar_title :  $categories[2]->en_title }}</h5>
                                <small class="text-primary">
                                    {{ __('ecommerce.details') }}
                                    <svg id="Arrow - Left" width="16px" height="16px" viewBox="0 0 24 24"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Iconly/Light/Arrow---Left" stroke="none" stroke-width="1"
                                            fill="none" fill-rule="evenodd" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <g id="Arrow---Left"
                                                transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) translate(5.500000, 4.000000)"
                                                stroke="#000000" stroke-width="1.6">
                                                <line x1="6.7743" y1="15.75" x2="6.7743" y2="0.75"
                                                    id="Stroke-1">
                                                </line>
                                                <polyline id="Stroke-3"
                                                    points="12.7987 9.7002 6.7747 15.7502 0.7497 9.7002">
                                                </polyline>
                                            </g>
                                        </g>
                                    </svg>
                                </small>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if (isset($categories[3]))
                <div class="col-lg-4 col-md-5 col-6 ppr-4">
                    <div class="category-card">
                        <a href="{{ route('ecommerce.category.show' , $categories[3]->id) }}">
                            <img loading="lazy" class="img-fluid" src="{{ asset($categories[3]->image)}}">
                            <div class="details">
                                <h5 class="text-white">{{ app()->getLocale() == 'ar'  ? $categories[3]->ar_title :  $categories[3]->en_title }}</h5>
                                <small class="text-primary">
                                    {{ __('ecommerce.details') }}
                                    <svg id="Arrow - Left" width="16px" height="16px" viewBox="0 0 24 24"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Iconly/Light/Arrow---Left" stroke="none" stroke-width="1"
                                            fill="none" fill-rule="evenodd" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <g id="Arrow---Left"
                                                transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) translate(5.500000, 4.000000)"
                                                stroke="#000000" stroke-width="1.6">
                                                <line x1="6.7743" y1="15.75" x2="6.7743" y2="0.75"
                                                    id="Stroke-1">
                                                </line>
                                                <polyline id="Stroke-3"
                                                    points="12.7987 9.7002 6.7747 15.7502 0.7497 9.7002">
                                                </polyline>
                                            </g>
                                        </g>
                                    </svg>
                                </small>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                @if (isset($categories[4]))
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="category-card">
                        <a href="{{ route('ecommerce.category.show' , $categories[4]->id) }}">
                            <img loading="lazy" class="img-fluid" src="{{ asset($categories[4]->image)}}">
                            <div class="details">
                                <h5 class="text-white">{{ app()->getLocale() == 'ar'  ? $categories[4]->ar_title :  $categories[4]->en_title }}</h5>
                                <small class="text-primary">
                                    {{ __('ecommerce.details') }}
                                    <svg id="Arrow - Left" width="16px" height="16px" viewBox="0 0 24 24"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Iconly/Light/Arrow---Left" stroke="none" stroke-width="1"
                                            fill="none" fill-rule="evenodd" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <g id="Arrow---Left"
                                                transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) translate(5.500000, 4.000000)"
                                                stroke="#000000" stroke-width="1.6">
                                                <line x1="6.7743" y1="15.75" x2="6.7743" y2="0.75"
                                                    id="Stroke-1">
                                                </line>
                                                <polyline id="Stroke-3"
                                                    points="12.7987 9.7002 6.7747 15.7502 0.7497 9.7002">
                                                </polyline>
                                            </g>
                                        </g>
                                    </svg>
                                </small>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
