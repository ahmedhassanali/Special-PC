@extends('ecommerce.layouts.app')

@section('content')
<section class="login-form page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-7 col-12">
                <div class="form">
                    <h4 class="text-dark mb-3">
                        {{ __('ecommerce.welcome') }}
                    </h4>
                    <p class="text-default d-flex align-items-center">
                        {{ __('ecommerce.if_no_account') }}
                        <a class="link text-primary" href="{{ route('ecommerce.register') }}">
                            {{ __('ecommerce.create_account') }}
                            <svg id="Arrow - Left" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Iconly/Light/Arrow---Left" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                    <g id="Arrow---Left"
                                        transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) translate(5.500000, 4.000000)"
                                        stroke="#000000" stroke-width="1.5">
                                        <line x1="6.7743" y1="15.75" x2="6.7743" y2="0.75"
                                            id="Stroke-1"></line>
                                        <polyline id="Stroke-3" points="12.7987 9.7002 6.7747 15.7502 0.7497 9.7002">
                                        </polyline>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </p>
                    <form class="row" action="{{ route('client.login') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-6 mb-2">
                            <label class="text-default">
                                {{ __('ecommerce.email') }}
                            </label>
                            <input type="email" class="form-control" name="email" id="" placeholder="{{ __('ecommerce.email_placeholder') }}" required>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label class="text-default">
                                {{ __('ecommerce.password') }}
                            </label>
                            <i class="togglePassword" id="togglePassword"></i>
                            <input type="password" class="form-control" name="password" id="" placeholder="XXXXXXXX" required>
                            {{-- <div class="mt-1">
                                <input type="checkbox" name="remember" value="remember">
                                <label class="text-dark">
                                    تذكرني
                                </label>
                            </div> --}}
                        </div>
                        <div class="col-12">
                            <div class="pos-ab">
                                <button type="submit" class="w-50 btn btn-primary">{{ __('ecommerce.login') }}</button>
                                <a class="link text-dark" href="{{ route('ecommerce.forgotPassword') }}">
                                    {{ __('ecommerce.forgot_password') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="bg-gray">
                    <h3 class="text-primary mb-3">{{ __('ecommerce.why_register') }}</h3>
                    <ul>
                        <li class="d-flex">
                            <img src="{{ asset('assets/ecommerce/img/star-blue.png')}}">
                            <p class="text-default">
                                {{ __('ecommerce.rate_products') }}
                            </p>
                        </li>
                        <li class="d-flex">
                            <img src="{{ asset('assets/ecommerce/img/package.png')}}">
                            <p class="text-default">
                                {{ __('ecommerce.track_orders') }}
                            </p>
                        </li>
                        <li class="d-flex">
                            <img src="{{ asset('assets/ecommerce/img/discount.png')}}">
                            <p class="text-default">
                                {{ __('ecommerce.get_offers') }}
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
