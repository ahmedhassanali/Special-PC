@extends('admin.layouts.admin')
@section('content')
<div class="page-content-wrapper m-3">
    @include('admin.layouts.error')
        <div class="row mb-3">
            <div class="col-12 my-2 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">
                    {{ __('dashboard.update') }}
                    {{ __('dashboard.offer') }}
                </h4>
            </div>
        </div>
    <div class="card">
        <div class="card-body">
            <form class="needs-validation row g-4" novalidate="" enctype="multipart/form-data"  action="{{ route('admin.offer.update',$offer) }}" method="post" >
                    @csrf
                <div class="col-md-6">
                    <label class="form-label">{{ __('dashboard.arabic_name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="name" class="form-control ar"
                            value="{{ isset($offer) ? $offer->ar_name : old('ar_name') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('dashboard.english_name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="en_name" class="form-control"
                            value="{{ isset($offer) ? $offer->en_name : old('en_name') }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <select class="form-control" name="type">
                        <option value="">{{ __('Select Type') }}</option>
                        <option  {{ isset($offer) && $offer->type == 1 ? 'selected' : '' }} value="1">{{ __('dashboard.value') }}</option>
                        <option  {{ isset($offer) && $offer->type == 2 ? 'selected' : '' }} value="2">{{ __('dashboard.persentage') }}</option>
                    </select>
                </div>


                <div class="col-md-4">
                    <label class="form-label">{{ __('dashboard.offer') }}</label>
                    <div class="input-group">
                        <input required type="number"  step="any" name="amount" class="form-control" value="{{ isset($offer) ? $offer->amount : old('amount') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ __('dashboard.start_date') }}</label>
                    <div class="input-group">
                        <input required type="date" name="start_date" class="form-control" value="{{ isset($offer) ? $offer->start_date : old('start_date') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ __('dashboard.end_date') }}</label>
                    <div class="input-group">
                        <input required type="date" name="end_date" class="form-control" value="{{ isset($offer) ? $offer->end_date : old('end_date') }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label">{{ __('dashboard.arabic_description') }}</label>
                    <div class="input-group">
                        <textarea name="ar_description" class="form-control ar">{{ isset($category) ? $category->ar_description : old('ar_description') }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label">{{ __('dashboard.english_description') }}</label>
                    <div class="input-group">
                        <textarea name="en_description" class="form-control">{{ isset($category) ? $category->en_description : old('en_description') }}</textarea>
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
