@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0"> {{ __('dashboard.captains') }}</h4>
                <a href="{{ route('admin.captain.create') }}" class="btn btn-primary mx-3 mt-3">
                    {{ __('dashboard.add_captain') }}
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

            <!-- Card body START -->
            <div class="card-body">
                <!-- Instructor request table START -->
                <div class="table-responsive border-0">
                    <table class="table align-middle p-4 mb-0 table-hover">
                          <thead class="table-light">
                            <tr>
                                <th scope="col" class="border-0 "> {{ __('dashboard.image') }}</th>
                                <th scope="col" class="border-0 "> {{ __('dashboard.name') }}</th>
                                <th scope="col" class="border-0 "> {{ __('dashboard.phone') }}</th>
                                <th scope="col" class="border-0 "> {{ __('dashboard.city') }}</th>
                                <th scope="col" class="border-0 "> {{ __('dashboard.status') }}</th>
                                <th scope="col" class="border-0"> {{ __('dashboard.actions')  }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($captains as $captain)
                                <tr>
                                    <td>
                                        <div class="avatar avatar-md mx-2">
                                            <img src="{{ $captain->image ? asset($captain->image) : asset('assets/images/default.png') }}"
                                                alt="..." class="avatar-img rounded-circle">
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6>
                                                <a
                                                    href="{{ route('admin.captain.edit', $captain->id) }}">{{ $captain->name }}</a>
                                            </h6>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6>
                                                <a href=""> {{ $captain->phone }}</a>
                                            </h6>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <h6>
                                                <a href="">
                                                    {{ $captain->city->en_name }}
                                                </a>
                                            </h6>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            @if ($captain->status == 1)
                                                <span class="badge green">{{ __('dashboard.active') }}</span>
                                            @else
                                                <span class="badge red">{{ __('dashboard.inactive') }}</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        <div class="action-btns">
                                        <a href="{{ route('admin.captain.edit', $captain->id) }}"
                                            class="link"> <i class="fa fa-edit"></i>
                                        </a>

                                        <button subject_id="{{ $captain->id }}" id="deleteSubject"
                                            class="link text-red"> <i class="fa fa-trash"></i>
                                        </button>

                                        <!-- <form class="d-inline"
                                            action="{{ route('admin.captain.changeStatus', $captain->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="link {{ $captain->status == App\Models\Captain::ACTIVE ? 'btn-secondary' : 'btn-success' }}">
                                                <i class="fas fa-lock"></i>
                                                {{ $captain->status == App\Models\captain::ACTIVE ? __('dashboard.inactive') : __('dashboard.active') }}
                                            </button>
                                        </form> -->

                                        <a href="{{ route('admin.captain.orders', $captain->id) }}"
                                            class="btn btn-sm btn-primary">{{ __('dashboard.orders') }}
                                        </a>

                                        
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="Activiationwitch">
                                                <label class="form-check-label" for="deactivate">الغاء التنشيط</label>
                                            </div>
                                         </div>    
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
    @include('admin.layouts.delete', ['route' => route('admin.captain.delete', ':id')])
