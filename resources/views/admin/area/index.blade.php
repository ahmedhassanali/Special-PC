@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between">
                    <h4 class="h4 mb-5 mb-sm-0 m-3">{{ __('dashboard.areas') }} ({{ $city->en_name }})</h4>
                </div>
            </div>
        <div class="card">
            <div class="p-3">
                <!-- Search and select START -->
                <div class="row g-3 align-items-center justify-content-between">
                    <!-- Search bar -->
                    <div class="col-md-12">
                        <form class="rounded position-relative">
                            <input class="form-control bg-body" type="search" placeholder="Search" aria-label="Search">
                            <button class="link text-gray px-3 py-0 position-absolute top-50 end-0 translate-middle-y"
                                type="submit">
                                <i class="fas fa-search fs-6 "></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Search and select END -->
            </div>
            <!-- Card body START -->
            <div class="card-body">
                <!-- Instructor request table START -->
                <div class="table-responsive border-0">
                    <table class="table align-middle p-4 mb-0 table-hover">
                        <!-- Table head -->
                          <thead class="table-light">
                            <tr>
                                <th scope="col" class="border-0 ">  {{ __('dashboard.arabic_name') }}</th>
                                <th scope="col" class="border-0 ">  {{ __('dashboard.english_name') }}</th>
                                <th scope="col" class="border-0 ">  {{ __('dashboard.delivery_fees') }}</th>
                                <th scope="col" class="border-0"> {{ __('dashboard.actions') }}</th>
                            </tr>
                        </thead>
                        <!-- Table body START -->

                        <tbody>
                            <!-- Table row -->
                            @foreach ($areas as $area)
                                <tr>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0"><a
                                                    href="{{ route('admin.area.edit', $area->id) }}">{{ $area->ar_name }}</a>
                                            </h6>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0"><a
                                                    href="{{ route('admin.area.edit', $area->id) }}">{{ $area->en_name }}</a>
                                            </h6>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">{{ $area->delivery_fees }}
                                            </h6>
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.area.edit', $area->id) }}"
                                            class="btn btn-primary btn-sm">{{ __('Edit') }} <i
                                                class="fa fa-edit"></i></a>

                                        <button subject_id="{{ $area->id }}" id="deleteSubject"
                                            class="btn btn-danger btn-sm">{{ __('Delete') }} <i
                                                class="fa fa-trash"></i></button>
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
    @include('admin.layouts.delete',['route' => route('admin.area.delete', ':id') ])
