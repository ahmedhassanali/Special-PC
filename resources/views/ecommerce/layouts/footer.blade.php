@php
    $settings = App\Models\Setting::first();
    $categories = App\Models\Category::get();
@endphp
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-6">
                <a href="index.html">
                    <img class="img-fluid logo" src="{{ asset('assets/ecommerce/img/special-pc-logo-white.png')}}">
                </a>
            </div>
            <div class="col-lg-5 col-md-7 col-sm-7 col-auto">
                <div class="download">
                    <p>
                        {{ __('ecommerce.download_app') }}
                    </p>
                    <div class="buttons">
                        <a href="{{ isset($settings) ? $settings->google_play_link : ''}}" class="btn bd-white">
                            {{ __('ecommerce.play_store') }}
                            <img src="{{ asset('assets/ecommerce/img/play-store.png')}}" class="icon">
                        </a>
                        <a href="{{ isset($settings) ? $settings->app_store_link : '' }}" class="btn bd-white">
                            {{ __('ecommerce.app_store') }}
                            <img src="{{ asset('assets/ecommerce/img/app-store.png')}}" class="icon">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mid">

            <div class="col-md-2 col-sm-3 col-6">
                <ul class="">
                    @foreach ($categories->chunk(ceil($categories->count() / 2))[0] as $category)
                        <li>
                            <a href="{{ route('ecommerce.category.show' , $category->id) }}">
                                {{ app()->getLocale() == 'ar' ? $category->ar_title : $category->en_title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-2 col-sm-3 col-6">
                <ul class="">
                    @foreach ($categories->chunk(ceil($categories->count() / 2))[1] as $category)
                        <li>
                            <a href="{{ route('ecommerce.category.show' , $category->id) }}">
                                {{ app()->getLocale() == 'ar' ? $category->ar_title : $category->en_title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-2 col-sm-3 col-6">
                <ul>
                    <li>
                        <a href="{{ route('about') }}">
                            {{ __('ecommerce.about_us') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('privacyTerms') }}">
                            {{ __('ecommerce.privacy_policy') }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-7">
                <h5 class="title-xs mb-3">
                    {{ __('ecommerce.follow_us') }}
                </h5>
                <ul class="social-links">
                    <li>
                        <a href="https://wa.me/+{{ isset($settings) ? $settings->whatsapp : ''}}">
                            <img src="{{ asset('assets/ecommerce/img/whatsapp.png')}}">
                        </a>
                    </li>
                    <li>
                        <a href="{{ isset($settings) ? $settings->snapchat : '' }}">
                            <img src="{{ asset('assets/ecommerce/img/snapchat.png')}}">
                        </a>
                    </li>
                    <li>
                        <a href="{{ isset($settings) ? $settings->tiktok : '' }}">
                            <img src="{{ asset('assets/ecommerce/img/tiktok.png')}}">
                        </a>
                    </li>
                    <li>
                        <a href="{{ isset($settings) ? $settings->x : '' }}">
                            <img src="{{ asset('assets/ecommerce/img/x.png')}}">
                        </a>
                    </li>
                    <li>
                        <a href="{{ isset($settings) ? $settings->facebook : '' }}">
                            <img src="{{ asset('assets/ecommerce/img/facebook.png')}}">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p> {{ __('ecommerce.all_rights_reserved') }}</p>
            <a href="https://www.softwarecloud2.com">Software Cloud 2</a>
            <p>
                2024
            </p>
        </div>
    </div>
</footer>
