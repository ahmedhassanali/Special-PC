@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.feedbacks') }}</h4>
            </div>
        </div>

        <div class="card">
            <div class="p-3">
                <div class="row g-3 align-items-center justify-content-between">
                    <!-- Search bar -->
                    <div class="col-md-12">
                        <form class="rounded position-relative">
                            <input class="form-control bg-body" type="search" placeholder="Search" aria-label="Search">
                            <button class="link text-gray px-3 py-0 position-absolute top-50 end-0 translate-middle-y"
                                type="submit">
                                <i class="fas fa-search fs-6"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Search and select END -->
            </div>
            <div class="card-body">
                <div class="table-responsive border-0">
                    <table class="table align-middle p-4 mb-0 table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="border-0">{{ __('dashboard.customer_name') }}</th>
                                <th scope="col" class="border-0">{{ __('dashboard.product_name') }}</th>
                                <th scope="col" class="border-0">{{ __('dashboard.feedBack') }}</th>
                                <th scope="col" class="border-0">{{ __('dashboard.rating') }}</th>
                            </tr>
                        </thead>
                        <!-- Table body START -->
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <!-- Table row -->
                                <tr>
                                    <!-- Table data -->
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <div class="mb-0 ms-2">
                                                <!-- Title -->
                                                <h6 class="mb-0">
                                                    <a href="{{ route('admin.customer.show', $feedback->customer_id) }}"
                                                        class="stretched-link">
                                                        {{ $feedback->customer->name }}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Table data -->
                                    <td>
                                        <h6 class="table-responsive-title mb-0">
                                            <a>
                                                {{ $feedback->product ? $feedback->product->ar_name : '' }}
                                            </a>
                                        </h6>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $feedback->feedback }}</p>
                                    </td>
                                    <!-- Table data -->
                                    <td>
                                        <ul class="list-inline mb-0">
                                            @for ($i = 0; $i < $feedback->rating; $i++)
                                                <li class="list-inline-item mr-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                            @endfor
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
