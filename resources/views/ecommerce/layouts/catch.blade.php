@php
    $nonav = true;
@endphp
@extends('ecommerce.layouts.app')
<style>
    .alert-warning {
        color: #894ed6 !important;
        background-color: #ffe2e0 !important;
        border-color: #f4433614 !important;
    }
</style>
@section('content')
    <section id="survey" class="survey page">
        <div class="container mt-5 pt-5">
            <div class="alert alert-warning  text-center">
                <h2 class="display-3">للاسف حدث خطأ , اذا استمرت المشكلة أتصل بنا!</h2>

            </div>
            <pre style="color: rgb(255 255 255) !important;position: relative;background-color: f00;" class="  text-danger">
                    {{ $message }}
                </pre>
        </div>
    </section>
@endsection
