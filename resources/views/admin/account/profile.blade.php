@extends('admin.layouts.admin')

@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mb-2 mb-sm-0">{{ __('dashboard.profile') }}</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="row g-4" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Profile picture -->
                    <div class="col-12 justify-content-center align-items-center">
                        <label class="form-label">{{ __('dashboard.profile_picture') }}</label>
                        <div class="d-flex align-items-center">
                            <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                                <!-- Avatar place holder -->
                                <span class="avatar avatar-xl">
                                    <img id="uploadfile-1-preview"
                                        class="avatar-img rounded-circle border border-white border-3"
                                        style="width: 150px; height:150px" src="{{ $user->user_image() }}" alt="">
                                </span>
                                <!-- Remove btn -->
                                <button type="button" class="uploadremove d-none link text-red">
                                    <i class="bi bi-x"></i>
                                </button>
                            </label>
                            <!-- Upload button -->

                        </div>
                    </div>

                    <!-- Full name -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.full_name') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="name"
                                value="{{ isset($user) ? $user->name : old('name') }}" placeholder="First name">
                        </div>

                    </div>


                    <!-- Email id -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.email') }}</label>
                        <input class="form-control" disabled type="email"
                            value="{{ isset($user) ? $user->email : old('email') }}" placeholder="Email id">
                    </div>

                    <!-- Phone number -->
                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.phone_number') }}</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ isset($user) ? $user->phone : old('phone') }}" placeholder="Phone number">
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

            @if (session('errors'))
                <div class="alert alert-danger">
                    {{ session('errors') }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
