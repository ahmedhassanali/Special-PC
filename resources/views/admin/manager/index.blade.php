@extends('admin.layouts.admin')

@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.manage_users') }}</h4>
                <a href="{{ route('admin.manager.create') }}" class="btn btn-primary mx-3 mt-3">
                    {{ __('dashboard.add_user') }}
                </a>
            </div>
        </div>

        <div class="card">
            <div class="p-3">
                <div class="row g-3 align-items-center justify-content-between">
                    <!-- Search bar -->
                    <div class="col-md-8">
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
                                <th scope="col" class="border-0">{{ __('dashboard.name') }}</th>
                                <th scope="col" class="border-0">{{ __('dashboard.phone') }}</th>
                                <th scope="col" class="border-0">{{ __('dashboard.email') }}</th>
                                <th scope="col" class="border-0">{{ __('dashboard.status') }}</th>
                                <th scope="col" class="border-0">{{ __('dashboard.role') }}</th>
                                <th scope="col" class="border-0">{{ __('dashboard.action') }}</th>
                            </tr>
                        </thead>

                        <!-- Table body START -->
                        <tbody>
                            <!-- Table row -->
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                            <div class="avatar avatar-md">
                                                <img src="{{ $user->user_image() }}" alt="..." class="avatar-img rounded-circle">
                                            </div>
                                            <div class="mb-0 ms-2">
                                                <h6>
                                                    <a href="#" class="stretched-link">
                                                        {{ $user->name }}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <h6 class="mb-0">
                                            {{ $user->phone }}
                                        </h6>
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        @if ($user->status == 1)
                                            <span class="badge green">{{ __('dashboard.active') }}</span>
                                        @else
                                            <span class="badge red">{{ __('dashboard.inactive') }}</span>
                                        @endif
                                    <td>
                                        {{ $user->user_role ? $user->user_role->role : '-' }}
                                    </td>

                                    <td>
                                        <div class="action-btns">
                                            <a href="{{ route('admin.manager.edit', $user->id) }}" class="link"> 
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <button user_id="{{ $user->id }}" id="deleteUser" class="link text-red">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="Activiationwitch">
                                                <label class="form-check-label" for="deactivate">الغاء التنشيط</label>
                                            </div>
                                         </div>    
                                            <!-- @if ($user->status == 1)
                                            <button user_id="{{ $user->id }}" id="desActiveUser" class="btn btn-secondary btn-sm">
                                                {{ __('dashboard.deactivate') }} <i class="fas fa-lock"></i>
                                            </button>
                                            @else
                                            <button user_id="{{ $user->id }}" id="activeUser" class="btn btn-success btn-sm">
                                                {{ __('dashboard.activate') }} <i class="fas fa-check"></i>
                                            </button>
                                            @endif -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    @include('admin.manager.scripts')
