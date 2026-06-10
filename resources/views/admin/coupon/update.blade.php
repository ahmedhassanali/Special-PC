@extends('admin.layouts.admin')
@section('content')
<div class="page-content-wrapper m-3">
    @include('admin.layouts.error')
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.update_coupon')  }}</h4>
            </div>
        </div>
    <div class="card">
        <div class="card-body">
            <form class="needs-validation row g-4" novalidate="" enctype="multipart/form-data"  action="{{ route('admin.coupon.update',$coupon) }}" method="post" >
                @csrf
                <div class="col-md-6">
                    <label class="form-label">{{ __('dashboard.code') }}</label>
                    <div class="input-group">
                        <input required type="text" name="code" class="form-control"
                            value="{{ isset($coupon) ? $coupon->code : old('code') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('dashboard.type') }}</label>
                    <select class="form-control" name="type">
                        <option value="">{{ __('dashboard.select_type') }}</option>
                        <option  {{ isset($coupon) && $coupon->type == 1 ? 'selected' : '' }} value="1">{{ __('dashboard.value') }}</option>
                        <option  {{ isset($coupon) && $coupon->type == 2 ? 'selected' : '' }} value="2">{{ __('dashboard.persentage') }}</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ __('dashboard.amount') }}</label>
                    <div class="input-group">
                        <input required type="number" step="any" name="amount" class="form-control" value="{{ isset($coupon) ? $coupon->amount : old('amount') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ __('dashboard.max_uses') }} </label>
                    <div class="input-group">
                        <input required type="number" step="any" name="max" class="form-control"  value="{{ isset($coupon) ? $coupon->max : old('max') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ __('dashboard.end_at') }}</label>
                    <div class="input-group">
                        <input required type="date" name="end_at" class="form-control" value="{{ isset($coupon) ? $coupon->end_at : old('end_at') }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label">{{ __('dashboard.notes') }}</label>
                    <div class="input-group">
                        <textarea name="notes" class="form-control" placeholder="notes">{{ isset($coupon) ? $coupon->notes : old('notes') }}</textarea>
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

