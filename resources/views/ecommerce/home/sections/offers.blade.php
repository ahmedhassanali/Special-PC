

<section class="banner">
    <div class="container">
        <a href="{{ route('offer') }}">
            <div class="d-column">
                <h1 class="title-md text-primary">
                    {{ app()->getLocale() == 'ar' && isset($settings->offer) ? $settings->offer->ar_name : $settings->offer->en_name }}
                </h1>
                <h3 class="title-md text-primary">
                    {{ app()->getLocale() == 'ar'  && isset($settings->offer) ?  $settings->offer->ar_description :  $settings->offer->en_description}}
                </h3>
                <div class="d-flex">
                    <p class="text-dark">
                        <svg id="Shield Done" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4.31245 12.879C4.31245 19.283 11.9845 21.606 11.9845 21.606C11.9845 21.606 19.6565 19.283 19.6565 12.879C19.6565 6.474 19.9345 5.974 19.3195 5.358C18.7035 4.742 12.9905 2.75 11.9845 2.75C10.9785 2.75 5.26545 4.742 4.65045 5.358C4.13767 5.87079 4.2445 5.17473 4.29467 9"
                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.8696" stroke="black"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        {{ __('ecommerce.guarantee') }}
                    </p>
                    <p class="text-dark">
                        <svg id="Arrow - Right Square" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.0861 12.0001H7.91406" stroke="black" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M12.3223 8.25208L13.2633 9.18908L13.7338 9.65758M16.0863 12.0001L12.3223 15.7481"
                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M2.75 12V7.916C2.75 4.889 4.635 2.75 7.665 2.75H16.334C19.364 2.75 21.25 4.889 21.25 7.916V16.084C21.25 19.111 19.364 21.25 16.334 21.25H7.665C4.645 21.25 2.75 19.111 2.75 16.084V15.3161"
                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        {{ __('ecommerce.return_policy') }}
                    </p>
                </div>
                <button class="btn bd-yellow">
                    {{ __('ecommerce.browse') }}
                    <svg id="Arrow - Left" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Iconly/Light/Arrow---Left" stroke="none" stroke-width="1" fill="none"
                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                            <g id="Arrow---Left"
                                transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) translate(5.500000, 4.000000)"
                                stroke="#000000" stroke-width="1.5">
                                <line x1="6.7743" y1="15.75" x2="6.7743" y2="0.75" id="Stroke-1"></line>
                                <polyline id="Stroke-3" points="12.7987 9.7002 6.7747 15.7502 0.7497 9.7002">
                                </polyline>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
        </a>
    </div>
</section>
