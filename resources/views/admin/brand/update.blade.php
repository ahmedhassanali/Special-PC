@extends('admin.layouts.admin')
@section('content')
<div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                 <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.update') }} {{ __('dashboard.brand') }}</h4>
            </div>
        </div>

    <div class="card">
        <div class="card-body">
            <form class="needs-validation row g-4" novalidate="" enctype="multipart/form-data"  action="{{ route('admin.brand.update',$brand) }}" method="post" >
                @csrf
                <!-- picture -->
                <div class="col-12 justify-content-center align-items-center">
                    <label class="form-label">{{ __('Brand picture') }}</label>
                    <div class="d-flex align-items-center">
                        <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                            <!-- Avatar place holder -->
                            <span class="avatar avatar-xl">
                                <img id="uploadfile-1-preview"
                                    class="avatar-img rounded-circle border border-white border-3"
                                    src="{{ isset($brand) ? asset($brand->image) : 'https://via.placeholder.com/150' }}"
                                    alt="" style="width: 150px; height:150px">
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

                <div class="col-12">
                    <label class="form-label">{{ __('dashboard.arabic_name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="ar_name" class="form-control ar"
                            value="{{ isset($brand) ? $brand->ar_name : old('ar_name') }}" placeholder="Arabic Name">
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">{{ __('dashboard.english_name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="en_name" class="form-control"
                            value="{{ isset($brand) ? $brand->en_name : old('en_name') }}" placeholder="English Name">
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label">{{ __('dashboard.arabic_description') }}</label>
                    <div class="input-group">
                        <textarea name="ar_description" class="form-control ar" placeholder="Arabic Description">{{ isset($brand) ? $brand->ar_description : old('ar_description') }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label">{{ __('dashboard.english_description') }}</label>
                    <div class="input-group">
                        <textarea name="en_description" class="form-control" placeholder="English Description">{{ isset($brand) ? $brand->en_description : old('en_description') }}</textarea>
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
