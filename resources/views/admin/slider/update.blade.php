@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        @include('admin.layouts.error')
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">
                    {{ __('dashboard.update_slider') }}
                </h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="needs-validation row g-4" novalidate="" enctype="multipart/form-data"
                    action="{{ route('admin.slider.update', $slider) }}" method="post">
                    @csrf
                    <!-- picture -->
                    <div class="col-12 justify-content-center align-items-center">
                        <label class="form-label">{{ __('dashboard.image') }}</label>
                        <div class="d-flex align-items-center">
                            <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                                <span class="">
                                    <img width="150" id="uploadfile-1-preview" class=" border border-white border-3"
                                        src="{{ isset($slider) ? asset($slider->image) : 'https://via.placeholder.com/150' }}"
                                        alt="" accept="image/*">
                                </span>
                                <!-- Remove btn -->
                                <button type="button" class="uploadremove link text-red">
                                    <i class="bi bi-x"></i>
                                </button>
                            </label>
                            <!-- Upload button -->
                            <label class="btn btn-primary mb-0 mx-2" for="uploadfile-1">{{ __('dashboard.change') }}</label>
                            <input id="uploadfile-1" class="form-control d-none" name="photo" type="file"
                                accept="image/*">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.arabic_title') }} </label>
                        <div class="input-group">
                            <input required type="text" name="ar_title" class="form-control ar"
                                value="{{ isset($slider) ? $slider->ar_title : old('ar_title') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.english_title') }}</label>
                        <div class="input-group">
                            <input required type="text" name="en_title" class="form-control"
                                value="{{ isset($slider) ? $slider->en_title : old('en_title') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.product') }}</label>
                        <select class="form-control" id="product_id" name="product_id">
                            <option value="">{{ __('Select Product') }}</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ isset($product) && $slider->product_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->en_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.status') }}</label>
                        <select class="form-control" name="status">
                            <option value="0" {{ isset($product) && $slider->status == 0 ? 'selected' : '' }}>
                                {{ __('dashboard.inactive') }}
                            </option>
                            <option value="1" {{ isset($product) && $slider->status == 1 ? 'selected' : '' }}>
                                {{ __('dashboard.active') }}
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.arabic_description') }}</label>
                        <div class="input-group">
                            <textarea name="ar_description" class="form-control ar">{{ isset($slider) ? $slider->ar_description : old('ar_description') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.english_description') }}</label>
                        <div class="input-group">
                            <textarea name="en_description" class="form-control">{{ isset($slider) ? $slider->en_description : old('en_description') }}</textarea>
                        </div>
                    </div>



                    <div class="d-sm-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-0">{{ __('dashboard.save') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
