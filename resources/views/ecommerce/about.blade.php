@extends('ecommerce.layouts.app')

<?php
$about_us = app()->getLocale() == 'ar' ? $settings->ar_about_us : $settings->en_about_us;
$about_us_length = mb_strlen($about_us);
$first_half = mb_substr($about_us, 0, ceil($about_us_length / 2));
$second_half = mb_substr($about_us, ceil($about_us_length / 2));
?>

@section('content')
    <section class="about page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7 order-md-1 order-2">
                    <h2 class="title-lg en text-dark mb-3">
                        Special pc
                    </h2>
                    <p class="text-default fs-14">
                        {{ $first_half }}
                    </p>
                </div>
                <div class="col-lg-6 col-md-5 jce order-md-2 order-1">
                    <img class="img-fluid" src="{{ asset('assets/ecommerce/img/iPad.png') }}">
                </div>

                <div class="col-lg-6 col-md-5 jcs order-md-3 order-3">
                    <img class="img-fluid" src="{{ asset('assets/ecommerce/img/MacBook.png')}}">
                </div>

                <div class="col-lg-6 col-md-7 order-md-4 order-4">
                    <p class="text-default fs-14">
                        {{ $second_half }}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
