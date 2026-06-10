@extends('admin.layouts.admin')
@section('content')
<div class="page-content-wrapper m-3">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between">
            <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.add_marketer') }}</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.marketers.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('dashboard.name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('dashboard.email') }}</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
