@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        @include('admin.layouts.error')
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">
                    {{ __('dashboard.add') }}
                    {{ __('dashboard.slider') }}
                     {{ __('dashboard.new') }}
                </h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="row g-4" action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 justify-content-center align-items-center">
                        <label class="form-label">{{ __('dashboard.image') }}</label>
                        <div class="d-flex align-items-center">
                            <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                                <span class="">
                                    <img width="150" id="uploadfile-1-preview" class=" border border-white border-3"
                                        src="{{ 'https://via.placeholder.com/150' }}" alt="" accept="image/*">
                                </span>
                                <!-- Remove btn -->
                                <button type="button" class="uploadremove link text-red">
                                    <i class="bi bi-x"></i>
                                </button>
                            </label>
                            <!-- Upload button -->
                            <label class="btn btn-primary mb-0 mx-2" for="uploadfile-1">{{ __('upload') }}</label>
                            <input id="uploadfile-1" class="form-control d-none" name="photo" type="file"
                                accept="image/*">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.arabic_title') }} </label>
                        <div class="input-group">
                            <input required type="text" name="ar_title" class="form-control ar"
                                value="{{ old('ar_title') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.english_title') }} </label>
                        <div class="input-group">
                            <input required type="text" name="en_title" class="form-control"
                                value="{{ old('en_title') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.product') }}</label>
                        <select class="form-control" name="product_id">
                            <option value="">{{ __('Select Product') }}</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->en_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.status') }}</label>
                        <select class="form-control" name="status">
                            <option value="">{{ __('Select status') }}</option>
                            <option value="0">{{ __('dashboard.active') }}</option>
                            <option value="1">{{ __('dashboard.inactive') }}</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.arabic_description') }}</label>
                        <div class="input-group">
                            <input required type="text" name="ar_description" class="form-control ar"
                                value="{{ old('ar_description') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.english_description') }} </label>
                        <div class="input-group">
                            <input required type="text" name="en_description" class="form-control"
                                value="{{ old('en_description') }}">
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
