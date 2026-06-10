@extends('admin.layouts.admin')
@section('content')
<div class="page-content-wrapper m-3">
    @include('admin.layouts.error')
        <div class="row mb-3">
            <div class="col-12 my-2 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">
                    {{ __('dashboard.add') }}
                     {{ __('dashboard.new') }}
                      {{ __('dashboard.offer') }}
                </h4>
            </div>
        </div>
    <div class="card">
        <div class="card-body">
            <form class="row g-4"
                action="{{ route('admin.offer.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <div class="col-md-6">
                    <label class="form-label">{{ __('dashboard.arabic_name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="ar_name" class="form-control ar" value="{{old('ar_name') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('dashboard.english_name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="en_name" class="form-control" value="{{old('en_name') }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <select class="form-select" name="type">
                        <option value="">{{ __('Select Type') }}</option>
                        <option value="1">{{ __('dashboard.value') }}</option>
                        <option value="2">{{ __('dashboard.persentage') }}</option>
                    </select>
                </div>


                <div class="col-md-4">
                    <label class="form-label">{{ __('dashboard.amount') }}</label>
                    <div class="input-group">
                        <input required type="number"  step="any" name="amount" class="form-control" value="{{old('amount') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ __('dashboard.start_date') }}
                    </label>
                    <div class="input-group">
                        <input required type="date" name="start_date" class="form-control" value="{{old('start_date') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ __('dashboard.end_date') }}</label>
                    <div class="input-group">
                        <input required type="date" name="end_date" class="form-control" value="{{old('end_date') }}">
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
