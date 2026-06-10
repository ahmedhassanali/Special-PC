@extends('admin.layouts.admin')
@section('content')
<div class="page-content-wrapper m-3">
    @include('admin.layouts.error')
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">
                    {{ __('dashboard.add') }}
                    {{ __('dashboard.coupon') }}
                    {{ __('dashboard.new') }}
                </h4>
            </div>
        </div>
    <div class="card">
        <div class="card-body">
            <form class="row g-4"
                action="{{ route('admin.coupon.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <div class="col-md-6">
                    <label class="form-label"> {{ __('dashboard.code') }}</label>
                    <div class="input-group">
                        <input required type="text" name="code" class="form-control" value="{{old('code') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('dashboard.type') }}</label>
                    <select class="form-control" name="type">
                        <option value="">{{ __('dashboard.select_type') }}</option>
                        <option value="1"> {{ __( 'dashboard.value') }}</option>
                        <option value="2">{{ __( 'dashboard.persentage') }}</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ __( 'dashboard.amount') }}</label>
                    <div class="input-group">
                        <input required type="number" step="any" name="amount" class="form-control" value="{{old('amount') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label"> {{ __( 'dashboard.max_uses') }}</label>
                    <div class="input-group">
                        <input required type="number" step="any" name="max" class="form-control" value="{{old('max') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ __( 'dashboard.end_at') }}</label>
                    <div class="input-group">
                        <input required type="date" name="end_at" class="form-control" value="{{old('end_at') }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label">{{ __( 'dashboard.notes') }}</label>
                    <div class="input-group">
                        <textarea name="notes" class="form-control" >{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="d-sm-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mb-0">{{ __( 'dashboard.save') }}</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection



