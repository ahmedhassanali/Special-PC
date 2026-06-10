@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.offers') }}</h4>
                <a href="{{ route('admin.offer.create') }}" class="btn btn-primary mx-3 mt-3">
                    {{ __('dashboard.add_offer') }}
                </a>
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
                                <i class="fas fa-search fs-6 "></i>
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
                                <th scope="col" class="border-0 ">{{ __('dashboard.name') }}</th>
                                <th scope="col" class="border-0 ">{{ __('dashboard.type') }}</th>
                                <th scope="col" class="border-0 ">{{ __('dashboard.amount') }}</th>
                                <th scope="col" class="border-0">{{ __('dashboard.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offers as $offer)
                                <tr>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">{{ $offer->en_name }}</h6>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">{{ $offer->type == 1 ? 'Value' : 'Persentage' }}</h6>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6 class="mb-0">{{ $offer->amount }}</h6>
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.offer.edit', $offer->id) }}"
                                            class="link"><i class="fa fa-edit"></i>
                                        </a>
                                        <button subject_id="{{ $offer->id }}" id="deleteSubject"
                                         class="link text-red">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    @endsection
    @include('admin.layouts.delete', ['route' => route('admin.offer.delete', ':id')])
