@extends('admin.layouts.admin')

@section('title')
    @lang('site.categories')
@endsection

@section('content')
    <div class="row row-sm">

        <div class="col-md-3 my-3">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">{{ __('dashboard.add_new_word') }}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.translation.addTranslation') }}">
                        @csrf
                        <div class="form-group row my-1">
                            <div class="col-12 form-group my-2">
                                <label>{{ __('dashboard.file') }}</label>
                                <select name="langFile" class="form-control ">
                                    @foreach ($langFiles as $file)
                                        <option value="{{ basename($file) }}">{{ basename($file) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 form-group my-2">
                                <label>{{ __('dashboard.key') }}</label>
                                <input type="text" class="form-control" name="key" placeholder="Key">
                            </div>

                            <div class="col-12 form-group my-2">
                                <label>{{ __('dashboard.english_value') }}</label>
                                <input type="text" class="form-control" name="englishValue" placeholder="English Value">
                            </div>

                            <div class="col-12 form-group my-2">
                                <label>{{ __('dashboard.arabic_value') }}</label>
                                <input type="text" class="form-control" name="arabicValue" placeholder="Arabic Value">
                            </div>

                            <button class="btn btn-primary m-2 col-11" type="submit">{{ __('dashboard.add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9 my-3">
            <div class="card">
                <div class="card-body">
                    <!-- editLang.blade.php -->
                    <form method="GET" action="{{ route('admin.translation.loadFileData') }}">
                        <div class="form-group row d-flex col-md-12 my-1">

                            <label class="col-md-12">{{ __('dashboard.file') }}</label>
                            <div class="col-md-10">
                                <select name="langFile" class="form-control mx-2">
                                    @foreach ($langFiles as $file)
                                        <option value="{{ basename($file) }}">{{ basename($file) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" type="submit">{{ __('dashboard.load') }}</button>
                            </div>
                        </div>
                    </form>
                </div>

                <ul class="nav nav-tabs mx-3 my-1" id="languageTabs" role="tablist">
                    <li class="nav-item mx-1">
                        <a class="nav-link  btn-primary" id="english-tab" data-toggle="tab" href="#englishFormTab"
                            role="tab" aria-controls="englishFormTab"
                            aria-selected="true">{{ __('dashboard.english') }}</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link active btn-primary" id="arabic-tab" data-toggle="tab" href="#arabicFormTab"
                            role="tab" aria-controls="arabicFormTab"
                            aria-selected="false">{{ __('dashboard.arabic') }}</a>
                    </li>
                </ul>

                <div class="tab-content" id="languageTabsContent">

                    <div class="tab-pane fade  show  m-2" id="englishFormTab" role="tabpanel" aria-labelledby="english-tab">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">{{ __('dashboard.english_translations') }}</h4>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- editLang.blade.php -->


                                @if (isset($englishSelectedLangFile))
                                    <form method="POST" class=""
                                        action="{{ route('admin.translation.saveLangFile') }}">
                                        @csrf
                                        <div class="row">
                                            @foreach ($englishLangData as $key => $value)
                                                <div class="col-md-4 my-2">
                                                    <label for="{{ $key }}">{{ $key }}</label>
                                                    <button type="button" class="btn delete-field p-1 m-2"><i
                                                        class="fa fa-trash text-danger p-0"> </i></button>

                                                    <input type="hidden" name="langFile"
                                                        value="{{ $englishSelectedLangFile }}">
                                                    <input type="text" class="form-control" name="{{ $key }}"
                                                        id="{{ $key }}" value="{{ $value }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="btn btn-primary m-2"
                                            type="submit">{{ __('dashboard.save') }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show active m-2" id="arabicFormTab" role="tabpanel"
                        aria-labelledby="arabic-tab">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">{{ __('dashboard.arabic_translations') }}</h4>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                            </div>
                            <div class="card-body">

                                @if (isset($arabicSelectedLangFile))
                                    <form method="POST" class=""
                                        action="{{ route('admin.translation.saveLangFile') }}">
                                        @csrf
                                        <div class="row">
                                            @foreach ($arabicLangData as $key => $value)
                                                <div id="group-{{ $key }}" class="col-md-4 my-2">
                                                    <label for="{{ $key }}">{{ $key }}</label>
                                                    <button type="button" class="btn delete-field p-1 m-2"><i
                                                            class="fa fa-trash text-danger p-0"> </i></button>

                                                    <input type="text" class="form-control"
                                                        name="{{ $key }}" id="{{ $key }}"
                                                        value="{{ $value }}">
                                                    <input type="hidden" name="langFile"
                                                        value="{{ $arabicSelectedLangFile }}">

                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="btn btn-primary m-2"
                                            type="submit">{{ __('dashboard.save') }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-field').click(function() {
                $(this).parent().remove();
            });
        });
    </script>
@endSection
