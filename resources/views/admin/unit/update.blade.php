@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        @include('admin.layouts.error')
        <div class="row mb-3">
            <div class="col-12 d-flex my-2 justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.update_unit') }}</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="needs-validation row g-4" novalidate="" enctype="multipart/form-data"
                    action="{{ route('admin.unit.update', $unit) }}" method="post">
                    @csrf

                    <div class="col-12">
                        <label class="form-label">{{ __('dashboard.arabic_name') }}</label>
                        <div class="input-group">
                            <input required type="text" name="ar_name" class="form-control ar"
                                value="{{ isset($unit) ? $unit->ar_name : old('ar_name') }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">{{ __('dashboard.english_name') }}</label>
                        <div class="input-group">
                            <input required type="text" name="en_name" class="form-control"
                                value="{{ isset($unit) ? $unit->en_name : old('en_name') }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{ __('dashboard.arabic') }}
                            {{ __('dashboard.short_name') }}
                        </label>
                        <div class="input-group">
                            <textarea name="ar_short_name" class="form-control ar">{{ isset($unit) ? $unit->ar_short_name : old('ar_short_name') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{ __('dashboard.english_short_name') }}</label>
                        <div class="input-group">
                            <textarea name="en_short_name" class="form-control">{{ isset($unit) ? $unit->en_short_name : old('en_short_name') }}</textarea>
                        </div>
                    </div>

                    <div class="d-sm-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-0 ar">{{ __('dashboard.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
