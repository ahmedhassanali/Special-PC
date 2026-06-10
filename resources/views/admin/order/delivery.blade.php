@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        @include('admin.layouts.error')
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">
                    {{ __('dashboard.update') }}
                     {{ __('dashboard.delivery') }}
                </h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="needs-validation row g-4" novalidate="" enctype="multipart/form-data"
                    action="{{ route('admin.order.update.delivery', $order->id) }}" method="post">
                    @csrf

                    <div class="col-md-12">
                        <label class="form-label">{{ __('Captain') }}</label>
                        <select class="form-control" name="captain_id">
                            <option value="">{{ __('Select Captain') }}</option>
                            @foreach ($captains as $captain)
                                <option value="{{ $captain->id }}"
                                    {{ isset($captain) && $order->captain_id == $captain->id ? 'selected' : '' }}>
                                    {{ $captain->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">
                            {{ __('dashboard.time') }}
                            {{ __('dashboard.receiving') }}
                            {{ __('dashboard.customer') }}
                        </label>
                        <div class="input-group">
                            <input required type="datetime-local" name="customer_receiving_time" class="form-control"
                                value="{{ isset($order) ? $order->customer_receiving_time : old('customer_receiving_time') }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{ __('dashboard.status') }}</label>
                        <div class="input-group">
                            <select class="form-control" name="status">
                                <option value="">{{ __('Select Status') }}</option>
                                <option
                                    value="{{ App\Models\Order::PROCESSING }}"{{ isset($order) && $order->status == App\Models\Order::PROCESSING ? 'selected' : '' }}>
                                    {{ __('dashboard.processing') }} </option>
                                <option
                                    value="{{ App\Models\Order::PREORDERED }}"{{ isset($order) && $order->status == App\Models\Order::PREORDERED ? 'selected' : '' }}>
                                    {{ __('dashboard.preordered') }}</option>
                                <option
                                    value="{{ App\Models\Order::SHIPPING }}"{{ isset($order) && $order->status == App\Models\Order::SHIPPING ? 'selected' : '' }}>
                                    {{ __('dashboard.shipping') }}</option>
                                <option
                                    value="{{ App\Models\Order::DELIVERED }}"{{ isset($order) && $order->status == App\Models\Order::DELIVERED ? 'selected' : '' }}>
                                    {{ __('dashboard.delivered') }}</option>
                                <option
                                    value="{{ App\Models\Order::FINISHED }}"{{ isset($order) && $order->status == App\Models\Order::FINISHED ? 'selected' : '' }}>
                                    {{ __('dashboard.finished') }}</option>
                                <option
                                    value="{{ App\Models\Order::CANCELLED }}"{{ isset($order) && $order->status == App\Models\Order::CANCELLED ? 'selected' : '' }}>
                                    {{ __('dashboard.cancelled') }}</option>
                                <option
                                    value="{{ App\Models\Order::RETURNED }}"{{ isset($order) && $order->status == App\Models\Order::RETURNED ? 'selected' : '' }}>
                                    {{ __('dashboard.returned') }} </option>
                            </select>
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
