<header class="fixed-top">
    @if (isset($settings->coupon))
        <div class="upper-header pp-4 bg-light-gray">
            <div class="container">
                {{-- <a class="close">
                    <svg id="Close Square" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.3941 9.59485L9.60205 14.3868" stroke="#717171" stroke-width="1.2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.3999 14.3931L9.59985 9.59314" stroke="#717171" stroke-width="1.2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                <span class="text-primary fs-12">أستخدم برومو كود
                    <span class="bg-white pp-2 fs-12">{{ $settings->coupon->code }}</span>
                </span>
                <h6 class="text-dark">
                    @if ($settings->coupon->type == 2)
                        خصم {{ $settings->coupon->amount }} %
                    @else
                        خصم {{ $settings->coupon->amount }} {{ __('ecommerce.currency') }}
                    @endif
                    <svg id="Plus" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.0369 8.46265V15.6111" stroke="#717171" stroke-width="1" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M15.6147 12.0369H8.45886" stroke="#717171" stroke-width="1" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.30005 12.0369C2.30005 4.73479 4.73479 2.30005 12.0369 2.30005C19.339 2.30005 21.7737 4.73479 21.7737 12.0369C21.7737 19.339 19.339 21.7737 12.0369 21.7737C4.73479 21.7737 2.30005 19.339 2.30005 12.0369Z"
                            stroke="#717171" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    شحن مجاني
                </h6>
                <small class="text-default">
                    {{ $settings->coupon->notes }}
                </small> --}}
            </div>
        </div>
    @endif

    <div class="mid-header">
        <div class="container-md">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img loading="lazy" src="{{ asset('assets/ecommerce/img/special-pc-logo-dark.png') }}"
                            class="">
                    </a>
                    <form class="search-form d-flex" action="{{ route('ecommerce.product.search') }}" role="search"
                        method="GET">
                        <input class="form-control me-2" name="search" placeholder="Search" aria-label="Search">
                        <button type="submit" class="btn btn-primary search-btn">
                            <img src="{{ asset('assets/ecommerce/img/Search-wh.png') }}" class="img-fluid">
                            <!-- {{ __('ecommerce.search') }} -->
                        </button>
                    </form>
                </div>
                <div class="col-md-6 col-sm-5">
                    @if (!Auth::guard('ecommerce')->check())
                        <a class="btn btn-primary" href="{{ route('ecommerce.login') }}">
                            {{ __('ecommerce.login') }}</a>
                        <div class="buttons ">
                            <a class="circle" href="{{ route('ecommerce.cart.show') }}">
                                @php
                                    $cartItems = session('cart_items', []);

                                    $totalQuantity = count($cartItems);
                                @endphp
                                <i>
                                    <p class="dot dot-md text-primary" id="cartIconCounter">
                                        {{ $totalQuantity }}</p>
                                </i>

                                <svg id="Buy" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
                            </a>
                        </div>
                    @else
                        <div class="buttons ">
                            <div class="btn-group">
                                <button type="button" class="circle dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <svg id="Profile" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Iconly/Light/Profile" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="Profile" transform="translate(4.814286, 2.814476)"
                                                stroke="#000000">
                                                <path
                                                    d="M7.17047619,12.531714 C3.30285714,12.531714 -4.08562073e-14,13.1164759 -4.08562073e-14,15.4583807 C-4.08562073e-14,17.8002854 3.28190476,18.4059997 7.17047619,18.4059997 C11.0380952,18.4059997 14.34,17.8202854 14.34,15.479333 C14.34,13.1383807 11.0590476,12.531714 7.17047619,12.531714 Z"
                                                    id="Stroke-1" stroke-width="1.5"></path>
                                                <path
                                                    d="M7.17047634,9.19142857 C9.70857158,9.19142857 11.7657144,7.13333333 11.7657144,4.5952381 C11.7657144,2.05714286 9.70857158,-5.32907052e-15 7.17047634,-5.32907052e-15 C4.6323811,-5.32907052e-15 2.574259,2.05714286 2.574259,4.5952381 C2.56571443,7.1247619 4.60952396,9.18285714 7.13809539,9.19142857 L7.17047634,9.19142857 Z"
                                                    id="Stroke-3" stroke-width="1.42857143"></path>
                                            </g>
                                        </g>
                                    </svg>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('ecommerce.profile') }}">
                                            <svg id="Profile" width="16px" height="16px" viewBox="0 0 24 24"
                                                version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <title>Iconly/Two-tone/Profile</title>
                                                <g id="Iconly/Two-tone/Profile" stroke="none" stroke-width="1"
                                                    fill="none" fill-rule="evenodd" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <g id="Profile" transform="translate(4.814286, 2.814476)"
                                                        stroke="#000000" stroke-width="1.5">
                                                        <path
                                                            d="M7.17047619,12.531714 C3.30285714,12.531714 -4.08562073e-14,13.1164759 -4.08562073e-14,15.4583807 C-4.08562073e-14,17.8002854 3.28190476,18.4059997 7.17047619,18.4059997 C11.0380952,18.4059997 14.34,17.8202854 14.34,15.479333 C14.34,13.1383807 11.0590476,12.531714 7.17047619,12.531714 Z"
                                                            id="Stroke-1"></path>
                                                        <path
                                                            d="M7.17047634,9.19142857 C9.70857158,9.19142857 11.7657144,7.13333333 11.7657144,4.5952381 C11.7657144,2.05714286 9.70857158,-5.32907052e-15 7.17047634,-5.32907052e-15 C4.6323811,-5.32907052e-15 2.574259,2.05714286 2.574259,4.5952381 C2.56571443,7.1247619 4.60952396,9.18285714 7.13809539,9.19142857 L7.17047634,9.19142857 Z"
                                                            id="Stroke-3" opacity="0.400000006"></path>
                                                    </g>
                                                </g>
                                            </svg>
                                            {{ __('ecommerce.my_profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('ecommerce.logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item" type="submit" id="logout">
                                                <svg id="Logout" width="16px" height="16px"
                                                    viewBox="0 0 24 24" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <g id="Iconly/Two-tone/Logout" stroke="none" stroke-width="1"
                                                        fill="none" fill-rule="evenodd" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <g id="Logout" transform="translate(2.000000, 2.000000)"
                                                            stroke="#000000" stroke-width="1.5">
                                                            <path
                                                                d="M13.016,5.3895 L13.016,4.4565 C13.016,2.4215 11.366,0.7715 9.331,0.7715 L4.456,0.7715 C2.422,0.7715 0.772,2.4215 0.772,4.4565 L0.772,15.5865 C0.772,17.6215 2.422,19.2715 4.456,19.2715 L9.341,19.2715 C11.37,19.2715 13.016,17.6265 13.016,15.5975 L13.016,14.6545"
                                                                id="Stroke-1" opacity="0.400000006"></path>
                                                            <line x1="19.8095" y1="10.0214" x2="7.7685"
                                                                y2="10.0214" id="Stroke-3"></line>
                                                            <polyline id="Stroke-5"
                                                                points="16.8812 7.1063 19.8092 10.0213 16.8812 12.9373">
                                                            </polyline>
                                                        </g>
                                                    </g>
                                                </svg>
                                                {{ __('ecommerce.logout') }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            <a class="circle"
                                href="{{ route('ecommerce.client.favorites', Auth::guard('ecommerce')->user()->id) }}">
                                <svg id="Heart" width="16px" height="16px" viewBox="0 0 24 24"
                                    version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Iconly/Two-tone/Heart" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Heart" transform="translate(2.500000, 3.000000)" stroke="#000000"
                                            stroke-width="1.5">
                                            <path
                                                d="M0.371865331,8.59832177 C-0.701134669,5.24832177 0.552865331,1.41932177 4.06986533,0.28632177 C5.91986533,-0.31067823 7.96186533,0.0413217701 9.49986533,1.19832177 C10.9548653,0.0733217701 13.0718653,-0.30667823 14.9198653,0.28632177 C18.4368653,1.41932177 19.6988653,5.24832177 18.6268653,8.59832177 C16.9568653,13.9083218 9.49986533,17.9983218 9.49986533,17.9983218 C9.49986533,17.9983218 2.09786533,13.9703218 0.371865331,8.59832177 Z"
                                                id="Stroke-1"></path>
                                            <path d="M13.5,3.7 C14.57,4.046 15.326,5.001 15.417,6.122" id="Stroke-3"
                                                opacity="0.400000006"></path>
                                        </g>
                                    </g>
                                </svg>
                            </a>

                            <a class="circle" href="{{ route('ecommerce.cart.show') }}">

                                @if (Auth::guard('ecommerce')->check() && Auth::guard('ecommerce')->user()->cart)
                                    @php
                                        $totalQuantity = Auth::guard('ecommerce')->user()->cart->items->sum('quantity');
                                    @endphp
                                    @if ($totalQuantity > 0)
                                        <i>
                                            <p class="dot dot-md text-primary" id="cartIconCounter">
                                                {{ $totalQuantity }}</p>
                                        </i>
                                    @endif
                                @endif

                                <svg id="Buy" width="16px" height="16px" viewBox="0 0 24 24"
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
                            </a>
                        </div>
                    @endif

                    <div class="btn-group">
                        <div class="dropdown topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                @switch(Session::get('lang'))
                                    @case('ar')
                                        العربية
                                    @break

                                    @default
                                        English
                                @endswitch
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                @switch(Session::get('lang'))
                                    @case('ar')
                                        <a href="{{ route('home', ['lang' => 'en']) }}" class="dropdown-item language py-2"
                                            data-lang="en" title="English">
                                            <span>English</span>
                                        </a>
                                    @break

                                    @default
                                        <a href="{{ route('home', ['lang' => 'ar']) }}" class="dropdown-item language"
                                            data-lang="sp" title="Spanish">
                                            <span>عربي</span>
                                        </a>
                                @endswitch
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#categories-nav"
                aria-controls="categories-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                {{ __('ecommerce.categories') }}
            </button>
            <div class="collapse navbar-collapse" id="categories-nav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        {{-- <a class="nav-link d-flex" href="category.html">
                            <svg id="Discount" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Iconly/Two-tone/Discount" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd">
                                    <g id="Discount" transform="translate(2.000000, 2.000000)">
                                        <path
                                            d="M2.7943,5.0558 C2.7943,3.8068 3.8073,2.7938 5.0553,2.7938 L6.0843,2.7938 C6.6803,2.7938 7.2533,2.5578 7.6773,2.1368 L8.3963,1.4168 C9.2773,0.5318 10.7093,0.5278 11.5943,1.4088 L11.6033,1.4168 L12.3233,2.1368 C12.7463,2.5578 13.3193,2.7938 13.9163,2.7938 L14.9443,2.7938 C16.1933,2.7938 17.2063,3.8068 17.2063,5.0558 L17.2063,6.0828 C17.2063,6.6808 17.4423,7.2528 17.8633,7.6768 L18.5833,8.3968 C19.4683,9.2778 19.4733,10.7088 18.5923,11.5948 L18.5833,11.6038 L17.8633,12.3238 C17.4423,12.7458 17.2063,13.3198 17.2063,13.9158 L17.2063,14.9448 C17.2063,16.1938 16.1933,17.2058 14.9443,17.2058 L13.9163,17.2058 C13.3193,17.2058 12.7463,17.4428 12.3233,17.8638 L11.6033,18.5828 C10.7233,19.4688 9.2913,19.4728 8.4053,18.5918 C8.4023,18.5888 8.3993,18.5858 8.3963,18.5828 L7.6773,17.8638 C7.2533,17.4428 6.6803,17.2058 6.0843,17.2058 L5.0553,17.2058 C3.8073,17.2058 2.7943,16.1938 2.7943,14.9448 L2.7943,13.9158 C2.7943,13.3198 2.5573,12.7458 2.1363,12.3238 L1.4173,11.6038 C0.5313,10.7228 0.5273,9.2908 1.4083,8.4058 L1.4173,8.3968 L2.1363,7.6768 C2.5573,7.2528 2.7943,6.6808 2.7943,6.0828 L2.7943,5.0558"
                                            id="Stroke-1" stroke="#000000" stroke-width="1.2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <line x1="7.43" y1="12.5695" x2="12.57" y2="7.4295" id="Stroke-3"
                                            stroke="#000000" stroke-width="1.2" opacity="0.400000006"
                                            stroke-linecap="round" stroke-linejoin="round"></line>
                                        <path
                                            d="M12.5667,13.3224 C12.3667,13.3224 12.1767,13.2424 12.0367,13.1024 C11.9667,13.0324 11.9167,12.9424 11.8767,12.8524 C11.8367,12.7624 11.8167,12.6734 11.8167,12.5724 C11.8167,12.4724 11.8367,12.3724 11.8767,12.2824 C11.9167,12.1924 11.9667,12.1124 12.0367,12.0424 C12.3167,11.7624 12.8167,11.7624 13.0967,12.0424 C13.1667,12.1124 13.2267,12.1924 13.2667,12.2824 C13.2967,12.3724 13.3167,12.4724 13.3167,12.5724 C13.3167,12.6734 13.2967,12.7624 13.2667,12.8524 C13.2267,12.9424 13.1667,13.0324 13.0967,13.1024 C12.9567,13.2424 12.7667,13.3224 12.5667,13.3224"
                                            id="Fill-5" fill="#000000" fill-rule="nonzero" opacity="0.400000006">
                                        </path>
                                        <path
                                            d="M7.4266,8.1828 C7.3266,8.1828 7.2366,8.1618 7.1466,8.1218 C7.0566,8.0818 6.9666,8.0328 6.8966,7.9628 C6.8266,7.8828 6.7766,7.8028 6.7366,7.7128 C6.6966,7.6218 6.6766,7.5328 6.6766,7.4328 C6.6766,7.3318 6.6966,7.2328 6.7366,7.1428 C6.7766,7.0528 6.8266,6.9628 6.8966,6.9028 C7.1866,6.6218 7.6766,6.6218 7.9566,6.9028 C8.0966,7.0418 8.1766,7.2328 8.1766,7.4328 C8.1766,7.5328 8.1666,7.6218 8.1266,7.7128 C8.0866,7.8028 8.0266,7.8828 7.9566,7.9628 C7.8866,8.0328 7.8066,8.0818 7.7166,8.1218 C7.6266,8.1618 7.5266,8.1828 7.4266,8.1828"
                                            id="Fill-7" fill="#000000" fill-rule="nonzero" opacity="0.400000006">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            عروض الأسبوع
                        </a> --}}
                    </li>
                    @php
                        $categories = App\Models\Category::get();
                    @endphp
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ecommerce.category.show', $category->id) }}">
                                {{ app()->getLocale() == 'ar' ? $category->ar_title : $category->en_title }}
                            </a>
                        </li>
                    @endforeach

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ecommerce.blog.index') }}">
                            {{ app()->getLocale() == 'ar' ? 'المدونة' : 'Blog' }}
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>
