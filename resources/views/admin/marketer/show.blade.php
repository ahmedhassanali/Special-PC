@extends('admin.layouts.admin')
@section('content')
<div class="page-content-wrapper m-3">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between">
            <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.marketer_details') }}</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>{{ __('dashboard.name') }}:</strong> {{ $marketer->name }}</p>
            <p><strong>{{ __('dashboard.email') }}:</strong> {{ $marketer->email }}</p>
            <p><strong>{{ __('dashboard.unique_link') }}:</strong> <a href="{{ $marketer->unique_link }}" target="_blank">{{ $marketer->unique_link }}</a></p>
            <p><strong>{{ __('dashboard.total_profit') }}:</strong> {{ $marketer->total_profit }}</p>
            <p><strong>{{ __('dashboard.link_usage_count') }}:</strong> {{ $marketer->link_usage_count }}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="h5">{{ __('dashboard.marketer_orders') }}</h5>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('dashboard.order_id') }}</th>
                        <th>{{ __('dashboard.customer_name') }}</th>
                        <th>{{ __('dashboard.order_total') }}</th>
                        <th>{{ __('dashboard.order_commission') }}</th> <!-- Added Commission Column -->
                        <th>{{ __('dashboard.order_paid') }}</th>
                        <th>{{ __('dashboard.order_date') }}</th>
                        <th>{{ __('dashboard.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($marketer->orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->marketer ? $order->total * 0.1 : 0 }}</td> <!-- Display Commission -->
                            <td>
                                @if ($order->paid == 1)
                                    <span class="text-success">
                                        <i class="fas fa-coins"></i> {{ __('dashboard.paid') }}
                                    </span>
                                @else
                                    <span class="text-danger">{{ __('dashboard.pending') }}</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-primary btn-sm">{{ __('dashboard.view') }}</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">{{ __('dashboard.no_orders_found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
