@extends('admin.layouts.admin')

@section('content')
    <div class="page-content-wrapper m-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.report.search') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">{{ __('dashboard.from') }}</label>
                            <input required class="form-control datetime-input mx-2 my-1 "
                                value="{{ request('date') ?: now()->toDateString() }}" id="date" name="startDate"
                                type="date">
                        </div>
                        <div class="col-md-4">
                            <label for="">{{ __('dashboard.to') }}</label>
                            <input required class="form-control datetime-input mx-2 my-1 "
                                value="{{ request('date') ?: now()->toDateString() }}" id="date" name="endDate"
                                type="date">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary my-4">{{ __('dashboard.search') }}</button>
                        </div>
                    </div>
                </form>
                <!-- Sale & Revenue Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-6 col-xl-4">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-line fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">{{ __('dashboard.total_products') }}</p>
                                    <h6 class="mb-0">{{ $products }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">{{ __('dashboard.male_customers') }}</p>
                                    <h6 class="mb-0">{{ $maleCustomer }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-area fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">{{ __('dashboard.female_customers') }}</p>
                                    <h6 class="mb-0">{{ $femaleCustomer }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">{{ __('dashboard.total_orders') }}</p>
                                    <h6 class="mb-0">{{ $numOfOrders }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">{{ __('dashboard.total_sales') }}</p>
                                    <h6 class="mb-0">{{ $totalOrderAmount }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">{{ __('dashboard.total_categories') }}</p>
                                    <h6 class="mb-0">{{ $numOfcategories }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sales Chart Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light text-center rounded p-4">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h6 class="mb-0">{{ __('dashboard.worldwide_sales') }}</h6>
                                </div>
                                <canvas id="worldwide-sales"></canvas>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light text-center rounded p-4">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h6 class="mb-0">{{ __('dashboard.salse_and_revenue') }}</h6>
                                </div>
                                <canvas id="salse-revenue"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
@endsection
