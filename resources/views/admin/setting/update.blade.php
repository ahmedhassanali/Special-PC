@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        @include('admin.layouts.error')
        <div class="row mb-3">
            <div class="col-12 my-2 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0 ar">
                    {{ __('dashboard.settings') }}
                </h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="needs-validation row g-4" novalidate="" id="setting_form" enctype="multipart/form-data"
                    action="{{ route('admin.setting.update') }}" method="post">
                    @csrf
                    <!-- picture -->
                    <div class="col-12 justify-content-center align-items-center">
                        <label class="form-label ar">{{ __('dashboard.logo') }}</label>
                        <div class="d-flex align-items-center">
                            <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                                <!-- Avatar place holder -->
                                <span class="">
                                    <img id="uploadfile-1-preview" style="width: 200px; "
                                        class="avatar-img rounded-circle border border-white border-3"
                                        src="{{ isset($setting) ? asset($setting->image) : 'https://via.placeholder.com/150' }}"
                                        alt="" accept="image/*">
                                </span>
                            </label>
                            <!-- Upload button -->
                            <label class="btn btn-primary mb-0 mx-2" for="uploadfile-1">{{ __('dashboard.upload') }}</label>
                            <input id="uploadfile-1" class="form-control d-none" name="photo" type="file"
                                accept="image/*">
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.arabic_title') }}</label>
                        <input type="text" name='ar_title' class="form-control"
                            value="{{ isset($setting) ? $setting->ar_title : '' }}" id="exampleInputName">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.english_title') }}</label>
                        <input type="text" name='en_title' class="form-control"
                            value="{{ isset($setting) ? $setting->en_title : '' }}" id="exampleInputName">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.x') }}</label>
                        <input type="text" name='x' class="form-control"
                            value="{{ isset($setting) ? $setting->x : '' }}" id="exampleInputX">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.instagram') }}</label>
                        <input type="text" name='instagram' class="form-control"
                            value="{{ isset($setting) ? $setting->instagram : '' }}" id="exampleInputInstagram">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.facebook') }}</label>
                        <input type="text" name='facebook' class="form-control"
                            value="{{ isset($setting) ? $setting->facebook : '' }}" id="exampleInputFacebook">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.tiktok') }}</label>
                        <input type="text" name='tiktok' class="form-control"
                            value="{{ isset($setting) ? $setting->tiktok : '' }}" id="exampleInputtiktok">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.whatsapp') }}</label>
                        <input type="tel" name='whatsapp' class="form-control"
                            value="{{ isset($setting) ? $setting->whatsapp : '' }}" id="exampleInputEmail">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.website') }}</label>
                        <input type="text" name='website' class="form-control"
                            value="{{ isset($setting) ? $setting->website : '' }}" id="exampleInputWhatsapp">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.email') }}</label>
                        <input type="email" name='email' class="form-control"
                            value="{{ isset($setting) ? $setting->email : '' }}" id="exampleInputEmail">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.phone') }}</label>
                        <input type="tel" name='phone' class="form-control"
                            value="{{ isset($setting) ? $setting->phone : '' }}" id="exampleInputEmail">
                    </div>
                    <div class="col-md-4">
                        <label class="ar">{{ __('dashboard.snapchat') }}</label>
                        <input type="text" name="snapchat" class="form-control"
                            value="{{ isset($setting) ? $setting->snapchat : old('snapchat') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.service_fee') }}</label>
                        <input type="number" name='service_fee' class="form-control"
                            value="{{ isset($setting) ? $setting->service_fee : '' }}" id="exampleInputservice_fee">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.tax') }}</label>
                        <input type="number" name='tax' class="form-control"
                            value="{{ isset($setting) ? $setting->tax : '' }}" id="exampleInputtax">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('dashboard.offer') }}</label>
                        <select class="form-control" id="offer_id" name="offer_id">
                            <option value="">{{ __('Select offer') }}</option>
                            @foreach ($offers as $offer)
                                <option value="{{ $offer->id }}"
                                    {{ isset($setting) && $setting->offer_id == $offer->id ? 'selected' : '' }}>
                                    {{ $offer->en_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('dashboard.coupon') }}</label>
                        <select class="form-control" id="coupon_id" name="coupon_id">
                            <option value="">{{ __('Select coupon') }}</option>
                            @foreach ($coupons as $coupon)
                                <option value="{{ $coupon->id }}"
                                    {{ isset($setting) && $setting->coupon_id == $coupon->id ? 'selected' : '' }}>
                                    {{ $coupon->code }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="">{{ __('dashboard.google_play_link') }}</label>
                        <input type="text" name="google_play_link" class="form-control"
                            value="{{ isset($setting) ? $setting->google_play_link : old('google_play_link') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="">{{ __('dashboard.app_store_link') }}</label>
                        <input type="text" name="app_store_link" class="form-control"
                            value="{{ isset($setting) ? $setting->app_store_link : old('app_store_link') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="">{{ __('dashboard.server_key') }}</label>
                        <input type="text" name="server_key" class="form-control"
                            value="{{ isset($setting) ? $setting->server_key : old('server_key') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.english_about_us') }}</label>
                        <textarea name='en_about_us' class="form-control" value="{{ isset($setting) ? $setting->en_about_us : '' }}"
                            id="exampleInputAboutUs"">{{ isset($setting) ? $setting->en_about_us : '' }}</textarea>
                    </div>


                    <div class="col-md-6">
                        <label for="exampleInputName1" class="ar">{{ __('dashboard.arabic_about_us') }}</label>
                        <textarea name='ar_about_us' class="form-control" value="{{ isset($setting) ? $setting->c : '' }}"
                            id="exampleInputAboutUs"">{{ isset($setting) ? $setting->ar_about_us : '' }}</textarea>
                    </div>

                    <div class="form-group col-6">
                        <label class="ar"> {{ __('dashboard.arabic_terms_conditions') }}</label>
                        <div id="editor" style="height: 200px;">
                            @if (isset($setting) && $setting->ar_terms_conditions)
                                {!! $setting->ar_terms_conditions !!}
                            @endif
                        </div>
                    </div>
                    <textarea name="ar_terms_conditions" id="arHiddenInput" style="display: none;"></textarea>

                    <div class="form-group col-6">
                        <label class="ar"> {{ __('dashboard.english_terms_conditions') }} </label>
                        <div id="editor1" style="height: 200px;">
                            @if (isset($setting) && $setting->en_terms_conditions)
                                {!! $setting->en_terms_conditions !!}
                            @endif
                        </div>
                    </div>
                    <textarea name="en_terms_conditions" id="enHiddenInput" style="display: none;"></textarea>
                    <div class="d-sm-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-0 ar">{{ __('dashboard.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
