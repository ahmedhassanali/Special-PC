@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        @include('admin.layouts.error')
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.add') }} {{ __('dashboard.new') }} {{ __('dashboard.unit') }}</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="row g-4" action="{{ route('admin.unit.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-12">
                        <label class="form-label">{{ __('dashboard.arabic_name') }}</label>
                        <div class="input-group">
                            <input required type="text" name="ar_name" class="form-control ar"
                                value="{{ old('ar_name') }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{ __('dashboard.english_name') }}</label>
                        <div class="input-group">
                            <input required type="text" name="en_name" class="form-control" value="{{ old('en_name') }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{ __('dashboard.arabic') }}
                            {{ __('dashboard.short_name') }}
                        </label>
                        <div class="input-group">
                            <input required type="text" name="ar_short_name" class="form-control ar"
                                value="{{ old('ar_short_name') }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{ __('dashboard.english_short_name') }}</label>
                        <div class="input-group">
                            <input required type="text" name="en_short_name" class="form-control"
                                value="{{ old('en_short_name') }}">
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
