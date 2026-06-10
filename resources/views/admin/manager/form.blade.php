@extends('admin.layouts.admin')

@section('content')
<div class="page-content-wrapper m-3">
    <div class="row mb-3">
                 <div class="col-12 my-2 d-flex justify-content-between">
                     <h4 class="h4 mt-3 mx-3 mb-sm-0">
                        {{ __('dashboard.manage_users') }}
                     </h4>
                 </div>
             </div>
    <div class="card">
            <div class="card-body">
                <form class="row g-4" action="{{ route('admin.manager.updateOrCreate', isset($user) ? $user->id : 0) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 justify-content-center align-items-center">
                        <label class="form-label">{{ __('Profile picture') }}</label>
                        <div class="d-flex align-items-center">
                            <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                                <!-- Avatar place holder -->
                                <span class="avatar avatar-xl">
                                    <img id="uploadfile-1-preview"
                                        class="avatar-img rounded-circle border border-white border-3"
                                        src="{{ isset($user) ? $user->user_image() : 'https://via.placeholder.com/150' }}"
                                        alt="" style="width: 150px; height:150px">
                                </span>
                                <!-- Remove btn -->
                                <button type="button" class="uploadremove link text-red">
                                    <i class="bi bi-x"></i>
                                </button>
                            </label>
                            <!-- Upload button -->
                            <label class="btn btn-primary mb-0" for="uploadfile-1">{{ __('dashboard.change') }}</label>
                            <input id="uploadfile-1" class="form-control d-none" name="photo" type="file">
                        </div>
                    </div>

                    <!-- Full name -->
                    <div class="col-12">
                        <label class="form-label">{{ __('dashboard.full_name') }}</label>
                        <div class="input-group">
                            <input type="text" name="name" class="form-control"
                                value="{{ isset($user) ? $user->name : old('name') }}" placeholder="First name">
                        </div>
                    </div>

                    <!-- Email id -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.email_id') }}</label>
                        <input class="form-control" name="email" type="email"
                            value="{{ isset($user) ? $user->email : old('email') }}" placeholder="Email id">
                    </div>

                    <!-- Phone number -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.phone_number') }}</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ isset($user) ? $user->phone : old('phone') }}" placeholder="Phone number">
                    </div>

                    <!-- Role -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.role') }}</label>
                        <select class="form-control" name="role">
                            <option value="">{{ __('Select Role') }}</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ isset($user) && $user->role == $role->id ? 'selected' : '' }}>{{ $role->role }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.password') }}</label>
                        <input class="form-control" name="password" type="password">
                    </div>

                    <!-- Save button -->
                    <div class="d-sm-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-0">{{ __('dashboard.save_changes') }}</button>
                    </div>
                </form>
            </div>
        </div>

        @if (session('errors'))
            <div class="alert alert-success">
                {{ session('errors') }}
            </div>
        @endif

    </div>
@endsection
