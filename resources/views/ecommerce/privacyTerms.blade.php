@extends('ecommerce.layouts.app')
@section('content')
    <section class="page">
        <div class="container">
            <ol>
                <li class="mb-3">
                    @if(app()->getLocale() == 'ar')
                        {!! $settings->ar_terms_conditions !!}
                    @else
                        {!! $settings->en_terms_conditions !!}
                    @endif
                </li>
            </ol>
        </div>
    </section>
@endsection
