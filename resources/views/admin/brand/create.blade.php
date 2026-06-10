@extends('admin.layouts.admin')
@section('content')
<div class="page-content-wrapper m-3">
    <div class="row mb-3">
        <div class="col-12 my-2 d-flex justify-content-between">
            <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.add_new_brand') }}</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="row g-4"
                action="{{ route('admin.brand.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <!-- picture -->
                <div class="col-12 justify-content-center align-items-center">
                    <label class="form-label">{{ __('dashboard.brand_picture') }}</label>
                    <div class="d-flex align-items-center">
                        <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                            <!-- Avatar place holder -->
                            <span class="avatar avatar-xl">
                                <img id="uploadfile-1-preview"
                                    class="avatar-img rounded-circle border border-white border-3"
                                    src="{{ isset($brand) ? $brand->image() : 'https://via.placeholder.com/150' }}"
                                    alt="" style="width: 150px;height:150px">
                            </span>
                            <!-- Remove btn -->
                            <button type="button" class="uploadremove link text-red">
                                <i class="bi bi-x"></i>
                            </button>
                        </label>
                        <!-- Upload button -->
                        <label class="btn btn-primary mb-0" for="uploadfile-1">{{ __('dashboard.change') }}</label>
                        <input id="uploadfile-1" class="form-control d-none" name="photo" type="file">
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label">{{ __('dashboard.arabic_name')  }}</label>
                    <div class="input-group">
                        <input required type="text" name="ar_name" class="form-control ar" value="{{old('ar_name') }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label">{{ __('dashboard.english_name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="en_name" class="form-control" value="{{old('en_name') }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label">{{ __('dashboard.arabic_description') }}</label>
                    <div class="input-group">
                        <input required type="text" name="ar_description" class="form-control ar" value="{{old('ar_description') }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label">{{ __('dashboard.english_description') }}</label>
                    <div class="input-group">
                        <input required type="text" name="en_description" class="form-control" value="{{old('en_description') }}">
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
