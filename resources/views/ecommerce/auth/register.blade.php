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
                        {{ __('ecommerce.login_prompt') }}
                        <a class="link text-primary" href="{{ route('ecommerce.login') }}">
                            {{ __('ecommerce.login') }}
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
                    <form class="row" action="{{ route('client.register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('ecommerce.layouts.errors')
                        <div class="col-lg-6 mb-2">
                            <label class="text-default">
                                {{ __('ecommerce.name') }}
                                <span class="text-red">*</span>
                            </label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="" placeholder="الأسم" required>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label class="text-default">
                                {{ __('ecommerce.phone_number') }}
                                <span class="text-red">*</span>
                            </label>
                            <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" id="" placeholder="0500000" required>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label class="text-default">
                                {{ __('ecommerce.email') }}
                                <span class="text-red">*</span>
                            </label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="" placeholder="البريد" required>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <div class="bg-orange">
                                <p class="text-orange">
                                    {{ __('ecommerce.verification_message') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label class="text-default">
                                {{ __('ecommerce.age') }}
                                <span class="text-gray">({{ __('ecommerce.optional') }})</span>
                            </label>
                            <input type="number" class="form-control" value="{{ old('age') }}" name="age" id=""  required>
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label class="text-default">
                                {{ __('ecommerce.gender') }}
                                <span class="text-gray">({{ __('ecommerce.optional') }})</span>
                            </label>
                            <div class="d-flex align-items-center justify-content-around">
                                <div>
                                    <input type="radio" name="gender" value="0">
                                    <label class="text-dark">
                                        {{ __('ecommerce.male') }}
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" name="gender"  value="1">
                                    <label class="text-dark">
                                        {{ __('ecommerce.female') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label class="text-default">
                                {{ __('ecommerce.password') }}
                                <span class="text-red">*</span>
                            </label>
                            <input type="password" name="password" class="form-control " id="" placeholder="XXXXXXXX" required>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label class="text-default">{{ __('ecommerce.confirm_password') }}
                                <span class="text-red">*</span>
                            </label>
                            <input type="password" name="password_confirmation" class="form-control" id="new_password_confirmation" placeholder="XXXXXXXX" required>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="mt-1">
                                {{-- <input type="checkbox" name="remember" value="remember"> --}}
                                <label class="text-dark">
                                    {{ __('ecommerce.agree_terms') }}
                                </label>

                            </div>

                        </div>

                        <div class="col-12">
                            <div class="pos-ab">
                                <button type="submit" class="mt-1 w-50 btn btn-primary">{{ __('ecommerce.create_account') }}</button>
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
                                {{ __('ecommerce.get_latest_offers') }}
                            </p>
                        </li>
                    </ul>

                </div>

            </div>

        </div>

    </div>
    <div class="pos-ab mt-5">
        <a class="link" href="{{ route('ecommerce.verificationCodeForm') }}">
            {{ __('ecommerce.registration_verification_prompt') }}
        </a>
    </div>
</section>
@endsection
