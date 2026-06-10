@extends('ecommerce.layouts.app')
@section('content')
<section class="login-form page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-7 col-12">
                <div class="form" >
                    <h4 class="text-dark mb-3 text-center">
                        {{ __('ecommerce.check_verification_code_title') }}
                    </h4>
                    <p class="text-default text-center">
                        {{ __('ecommerce.check_verification_code_description') }}
                    </p>
                    <form class="row" action="{{ route('ecommerce.resetPasswordCheckCode') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-6 mb-2">
                            @include('admin.layouts.error')

                            @if (!isset($email))
                            <div class="col-lg-12 mb-2">
                                <label class="text-default">
                                    {{ __('ecommerce.email') }}
                                </label>
                                <input type="email" class="form-control" name="email" id="" placeholder="{{ __('ecommerce.email_placeholder') }}" required>
                            </div>
                            @else
                                <input type="email" class="form-control" hidden name="email" value="{{ $email }}" placeholder="{{ __('ecommerce.email_placeholder') }}" required>
                            @endif
                            <label class="text-default">
                                {{ __('ecommerce.code') }}
                            </label>
                            <div id="inputs" class="inputs">
                                <input class="form-control input" type="text" name="num1" inputmode="numeric" maxlength="1" />
                                <input class="form-control input" type="text" name="num2" inputmode="numeric" maxlength="1" />
                                <input class="form-control input" type="text" name="num3" inputmode="numeric" maxlength="1" />
                                <input class="form-control input" type="text" name="num4" inputmode="numeric" maxlength="1" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="pos-ab">
                                <button type="submit" class="w-50 btn btn-primary">{{ __('ecommerce.submit') }}</button>
                                <a class="link" id="resend" href="{{ route('ecommerce.forgotPassword') }}">
                                    {{ __('ecommerce.resend_code') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
