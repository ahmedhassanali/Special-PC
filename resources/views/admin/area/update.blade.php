@extends('admin.layouts.admin')
@section('content')
<div class="col-xl-12">
    @include('admin.layouts.error')
    <div class="card">
        <div class="row mb-3">
            <div class="col-12 my-2 d-flex justify-content-between">
                 <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.update_area') }}</h4>
            </div>
        </div>
        <div class="card-body">
                <form class="needs-validation row g-4" novalidate="" enctype="multipart/form-data"  action="{{ route('admin.area.update',$area) }}" method="post" >
                    @csrf
                <div class="col-12">
                    <label class="form-label">{{ __('dashboard.arabic_name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="ar_name" class="form-control"
                            value="{{ isset($area) ? $area->ar_name : old('ar_name') }}" placeholder="Arabic Name">
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">{{ __('dashboard.english_name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="en_name" class="form-control"
                            value="{{ isset($area) ? $area->en_name : old('en_name') }}" placeholder="English Name">
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label"> {{ __('dashboard.delivery_fees') }}</label>
                    <div class="input-group">
                        <input required type="number" name="delivery_fees" class="form-control"
                            value="{{ isset($area) ? $area->delivery_fees : old('delivery_fees') }}" placeholder="Delivery Fees">
                    </div>
                </div>

                <div class="d-sm-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mb-0">{{ __('dashboard.update') }}</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
