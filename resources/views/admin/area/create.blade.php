@extends('admin.layouts.admin')
@section('content')
<div class="page-content-wrapper m-3">
    @include('admin.layouts.error')
    <div class="row mb-3">
		<div class="col-12 my-2 justify-content-between">
			<h4 class="h4 mt-3 mx-3 mb-sm-0">
                {{ __('dashboard.add_area') }} ({{ $city->en_name }})
            </h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form class="row g-4"
                action="{{ route('admin.area.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <div class="col-12">
                    <label class="form-label">{{ __('dashboard.arabic_name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="ar_name" class="form-control"
                            value="{{old('ar_name') }}" placeholder="Arabic Name">
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">{{ __('dashboard.english_name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="en_name" class="form-control"
                            value="{{old('en_name') }}" placeholder="English Name">
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">{{ __('dashboard.delivery_fees') }}</label>
                    <div class="input-group">
                        <input required type="number" name="delivery_fees" class="form-control"
                            value="{{old('delivery_fees') }}" placeholder="Delivery Fees">
                    </div>
                </div>

                <input hidden name="city_id" value="{{ $city->id }}">

                <div class="d-sm-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mb-0">{{ __('dashboard.save') }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
