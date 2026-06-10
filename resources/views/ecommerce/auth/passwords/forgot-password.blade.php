@extends('ecommerce.layouts.app')
@section('content')
<section class="login-form page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-7 col-12">
                <div class="form">
                    <h4 class="text-dark mb-3 text-center">
                        {{ __('ecommerce.reset_password_title') }}
                    </h4>
                    <p class="text-default text-center">
                        {{ __('ecommerce.reset_password_description') }}
                    </p>
                    <form class="row" action="{{ route('ecommerce.resetPasswordEmail') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-6 mb-2">
                            <label class="text-default">
                                {{ __('ecommerce.email') }}
                            </label>
                            <input type="email" name="email" class="form-control"  placeholder="{{ __('ecommerce.email') }}" required>
                        </div>
                        <div class="col-12">
                            <div class="pos-ab">
                                <button type="submit" class="w-50 btn btn-primary">{{ __('ecommerce.send_code') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
