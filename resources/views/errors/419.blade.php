@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
            <div class="col-md-6 text-center p-4">
                <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                <h1 class="display-1 fw-bold">419</h1>
                <h1 class="mb-4">Looks like you need to login again </h1>
                <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('login') }}">Go To Login Page</a>
            </div>
        </div>
    </div>
@endsection
