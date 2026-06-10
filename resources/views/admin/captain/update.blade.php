@extends('admin.layouts.admin')
@section('content')
<div class="page-content-wrapper m-3">
    @include('admin.layouts.error')
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                 <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.update_captain') }}</h4>
            </div>
        </div>
    <div class="card">
        <div class="card-body">
                <form class="needs-validation row g-4" novalidate="" enctype="multipart/form-data"  action="{{ route('admin.captain.update',$captain) }}" method="post" >
                    @csrf
                <!-- picture -->
                <div class="col-12 justify-content-center align-items-center">
                    <label class="form-label">{{ __('dashboard.image') }}</label>
                    <div class="d-flex align-items-center">
                        <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                            <!-- Avatar place holder -->
                            <span class="">
                                <img width="150" id="uploadfile-1-preview"
                                    class="border border-white border-3"
                                    src="{{ isset($captain) ? asset($captain->image) : 'https://via.placeholder.com/150' }}"
                                    alt="" accept="image/*">
                            </span>
                            <!-- Remove btn -->
                            <button type="button" class="uploadremove link text-red">
                                <i class="bi bi-x"></i>
                            </button>
                        </label>
                        <!-- Upload button -->
                        <label class="btn btn-primary mb-0 mx-2" for="uploadfile-1"> {{ __('dashboard.change') }}</label>
                        <input id="uploadfile-1" class="form-control d-none" name="photo" type="file"
                            accept="image/*">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label"> {{ __('dashboard.name') }}</label>
                    <div class="input-group">
                        <input required type="text" name="name" class="form-control"
                            value="{{ isset($captain) ? $captain->name : old('name') }}" placeholder="name">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label"> {{ __('dashboard.email') }}</label>
                    <div class="input-group">
                        <input required type="email" name="email" class="form-control" value="{{ isset($captain) ? $captain->email : old('email') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label"> {{ __('dashboard.age') }}</label>
                    <div class="input-group">
                        <input required type="number" name="age" class="form-control" value="{{ isset($captain) ? $captain->age : old('age') }}">
                    </div>
                </div>

                  <!-- Phone number -->
                  <div class="col-md-4">
                    <label class="form-label">{{ __('dashboard.phone_number') }}</label>
                    <input type="text" name="phone" class="form-control"
                        value="{{ isset($captain) ? $captain->phone : old('phone') }}" placeholder="Phone number">
                </div>

                <!-- Role -->
                <div class="col-md-4">
                    <label class="form-label">{{ __('dashboard.city') }}</label>
                    <select class="form-control" name="city_id">
                        <option value="">{{ __('dashboard.select_role') }}</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}"
                                {{ isset($city) && $captain->city_id == $city->id ? 'selected' : '' }}>{{ $city->en_name }}
                            </option>
                        @endforeach
                    </select>
                </div>



                <div class="d-sm-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mb-0">{{ __('dashboard.update') }}</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
