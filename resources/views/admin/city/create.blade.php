@extends('admin.layouts.admin')
@section('content')
<div class="col-xl-12">
    @include('admin.layouts.error')
    <div class="card">
        <div class="row mb-3">
            <div class="col-12 my-2 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">
                    {{ 'dashboard.add' }}
                    {{ 'dashboard.city' }}
                    {{ 'dashboard.new' }}</h4>
            </div>
        </div>
        <div class="card-body">
            <form class="row g-4"
                action="{{ route('admin.city.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <div class="col-md-6">
                    <label class="form-label"> {{ __('dashboard.arabic_name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="ar_name" class="form-control"
                            value="{{old('ar_name') }}" placeholder="Arabic Name">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label"> {{ __('dashboard.english_name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="en_name" class="form-control"
                            value="{{old('en_name') }}" placeholder="English Name">
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
