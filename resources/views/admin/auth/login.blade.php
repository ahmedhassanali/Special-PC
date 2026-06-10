@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-end login-form" style="min-height: 100vh;">

            <div class="col-12">
                <div class="form">
                    <div class="mb-3 d-flex justify-content-center">
                        <a href="index.html" class="d-flex align-items-center">
                            <img class="img-fluid logo" src="{{ asset('assets/ecommerce/img/special-pc-logo-dark.png')}}">
                            <h5 class="text-primary">
                                {{ __('dashboard.special-PC') }}
                            </h5>
                        </a>
                    </div>
                    <form class="row" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="col-md-12 mb-3">
                            <label class="text-default">{{ __('dashboard.email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required id="" placeholder="name@example.com"
                                autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-4">
                            <label class="text-default">{{ __('dashboard.password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required id="" placeholder="Password"
                                autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="pos-ab">
                        <button type="submit" class="btn btn-primary w-100">{{ __('dashboard.sign_in') }}</button>
                            @if (Route::has('password.request'))
                             <a class="link text-default" href="{{ route('password.request') }}">{{ __('dashboard.forgot_password') }}</a>
                            @endif
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
